<?php

namespace App\Utilities;

use App\Jobs\Auth\NotifyUser;
use App\Notifications\Common\ImportCompleted;
use Maatwebsite\Excel\Validators\ValidationException;
use Throwable;

class Import
{
    /**
     * Import the excel file or catch errors
     *
     * @param $class
     * @param $request
     * @param $translation
     *
     * @return array
     */
    public static function fromExcel($class, $request, $translation)
    {
        try {
            $file = $request->file('import');

            if (should_queue()) {
                $class->queue($file)->onQueue('imports')->chain([
                    new NotifyUser(user(), new ImportCompleted),
                ]);

                $message = trans('messages.success.import_queued', ['type' => $translation]);
            } else {
                $class->import($file);

                $message = trans('messages.success.imported', ['type' => $translation]);
            }

            $response = [
                'success'   => true,
                'error'     => false,
                'data'      => null,
                'message'   => $message,
            ];
        } catch (Throwable $e) {
            if ($e instanceof ValidationException) {
                foreach ($e->failures() as $failure) {
                    $message = trans('messages.error.import_column', [
                        'message'   => collect($failure->errors())->first(),
                        'column'    => $failure->attribute(),
                        'line'      => $failure->row(),
                    ]);

                    flash($message)->error()->important();
                }

                $message = '';
            } else {
                $message = $e->getMessage();
            }

            $response = [
                'success'   => false,
                'error'     => true,
                'data'      => null,
                'message'   => $message,
            ];
        }

        return $response;
    }
}
