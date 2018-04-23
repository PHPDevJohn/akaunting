<?php

namespace App\Listeners\Updates;

use App\Events\UpdateFinished;
use App\Models\Auth\Role;
use App\Models\Auth\Permission;
use App\Models\Company\Company;
use App\Models\Expense\Bill;
use App\Models\Income\Invoice;
use App\Models\Setting\Category;
use Artisan;

class Version120 extends Listener
{
    const ALIAS = 'core';

    const VERSION = '1.2.0';

    /**
     * Handle the event.
     *
     * @param  $event
     * @return void
     */
    public function handle(UpdateFinished $event)
    {
        // Check if should listen
        if (!$this->check($event)) {
            return;
        }

        $this->updatePermissions();

        // Update database
        Artisan::call('migrate', ['--force' => true]);

        $this->updateInvoicesAndBills();
    }

    protected function updatePermissions()
    {
        $permissions = [];

        // Create tax summary permission
        $permissions[] = Permission::firstOrCreate([
            'name' => 'read-reports-tax-summary',
            'display_name' => 'Read Reports Tax Summary',
            'description' => 'Read Reports Tax Summary',
        ]);

        // Create profit loss permission
        $permissions[] = Permission::firstOrCreate([
            'name' => 'read-reports-profit-loss',
            'display_name' => 'Read Reports Profit Loss',
            'description' => 'Read Reports Profit Loss',
        ]);

        // Attach permission to roles
        $roles = Role::all();

        foreach ($roles as $role) {
            $allowed = ['admin', 'manager'];

            if (!in_array($role->name, $allowed)) {
                continue;
            }

            foreach ($permissions as $permission) {
                $role->attachPermission($permission);
            }
        }
    }

    protected function updateInvoicesAndBills()
    {
        $companies = Company::all();

        foreach ($companies as $company) {
            // Invoices
            $invoice_category = Category::create([
                'company_id' => $company->id,
                'name' => trans_choice('general.invoices', 2),
                'type' => 'income',
                'color' => '#00c0ef',
                'enabled' => '1'
            ]);

            foreach ($company->invoices as $invoice) {
                $invoice->category_id = $invoice_category->id;
                $invoice->save();
            }

            // Bills
            $bill_category = Category::create([
                'company_id' => $company->id,
                'name' => trans_choice('general.bills', 2),
                'type' => 'expense',
                'color' => '#dd4b39',
                'enabled' => '1'
            ]);

            foreach ($company->bills as $bill) {
                $bill->category_id = $bill_category->id;
                $bill->save();
            }
        }
    }
}
