<?php

namespace Modules\OfflinePayments\Listeners;

use App\Events\Module\SettingShowing as Event;

class ShowSetting
{
    /**
     * Handle the event.
     *
     * @param  Event $event
     * @return void
     */
    public function handle(Event $event)
    {
        $event->modules->settings['offline-payments'] = [
            'name' => trans('offline-payments::general.name'),
            'description' => trans('offline-payments::general.description'),
            'url' => route('offline-payments.edit'),
            'icon' => 'fas fa-credit-card',
        ];
    }
}
