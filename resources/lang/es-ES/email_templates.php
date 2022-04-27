<?php

return [

    'invoice_new_customer' => [
        'subject'       => 'Factura No. {invoice_number} creada',
        'body'          => 'Apreciado {customer_name},<br /><br />Hemos preparado la siguiente factura: <strong>{invoice_number}</strong>.<br /><br />Puede ver los detalles de la factura y proceder con el pago desde el siguiente enlace: <a href="{invoice_guest_link}">{invoice_number}</a>.<br /><br />No dude en contactarnos si tiene alguna inquietud.<br /><br />Cordialmente,<br />{company_name}.',
    ],

    'invoice_remind_customer' => [
        'subject'       => 'Factura No. {invoice_number} vencida',
        'body'          => 'Apreciado {customer_name},<br /><br />Le notificamos que tiene una factura vencida No. <strong>{invoice_number}</strong>.<br /><br />El total a pagar es {invoice_total} y venció el <strong>{invoice_due_date}</strong>.<br /><br />Puede ver los detalles de la factura y proceder con el pago desde el siguiente enlace: <a href="{invoice_guest_link}">{invoice_number}</a>.<br /><br />Cordialmente,<br />{company_name}',
    ],

    'invoice_remind_admin' => [
        'subject'       => 'Factura No. {invoice_number} vencida',
        'body'          => 'Hola,<br /><br />{customer_name} ha recibido un aviso de vencimiento por la factura <strong>{invoice_number}</strong>.<br /><br />El total de la factura es {invoice_total} y venció el <strong>{invoice_due_date}</strong>.<br /><br />Puede ver los detalles de la factura desde el siguiente enlace: <a href="{invoice_admin_link}">{invoice_number}</a>.<br /><br />Saludos cordiales,<br />{company_name}',
    ],

    'invoice_recur_customer' => [
        'subject'       => 'Factura recurrente No. {invoice_number} creada',
        'body'          => 'Apreciado {customer_name},<br /><br />Basado en su círculo recurrente, le hemos preparado la siguiente factura: <strong>{invoice_number}</strong>.<br /><br />Puede ver los detalles de la factura y proceder con el pago desde el siguiente enlace: <a href="{invoice_guest_link}">{invoice_number}</a>.<br /><br />No dude en contactarnos si tiene alguna inquietud.<br /><br />Cordialmente,<br />{company_name}',
    ],

    'invoice_recur_admin' => [
        'subject'       => 'Factura recurrente No. {invoice_number} creada',
        'body'          => 'Hola,<br /><br />Basado en el círculo recurrente de {customer_name}, la factura <strong>{invoice_number}</strong> ha sido creada automáticamente.<br /><br />Puede ver los detalles de la factura desde el siguiente enlace: <a href="{invoice_admin_link}">{invoice_number}</a>.<br /><br />Saludos cordiales,<br />{company_name}',
    ],

    'invoice_payment_customer' => [
        'subject'       => 'Pago recibido por factura No. {invoice_number}',
        'body'          => 'Apreciado {customer_name},<br /><br />Gracias por la realización del pago. Encuentre los detalles a continuación:<br /><br />-------------------------------------------------<br /><br />Monto: <strong>{transaction_total}<br /></strong>Fecha: <strong>{transaction_paid_date}</strong><br />Factura número: <strong>{invoice_number}<br /><br /></strong>-------------------------------------------------<br /><br />Siempre puede ver los detalles de la factura desde el siguiente enlace: <a href="{invoice_guest_link}">{invoice_number}</a>.<br /><br />No dude en contactarnos si tiene alguna inquietud.<br /><br />Cordialmente,<br />{company_name}',
    ],

    'invoice_payment_admin' => [
        'subject'       => 'Pago recibido por factura No. {invoice_number}',
        'body'          => 'Hola,<br /><br />{customer_name} registró un pago por la factura <strong>{invoice_number}</strong>.<br /><br />Puede ver los detalles de la factura desde el siguiente enlace: <a href="{invoice_admin_link}">{invoice_number}</a>.<br /><br />Saludos cordiales,<br />{company_name}',
    ],

    'bill_remind_admin' => [
        'subject'       => 'Aviso recordatorio de factura {bill_number}',
        'body'          => 'Hola,<br /><br />Este es un aviso recordatorio para el recibo <strong>{bill_number}</strong> de {vendor_name}.<br /><br />El total de la recibo a pagar es de {bill_total} y vence <strong>{bill_due_date}</strong>.<br /><br />Puedes ver los detalles de la recibo desde el siguiente enlace: <a href="{bill_admin_link}">{bill_number}</a>.<br /><br />Saludos cordiales,<br />{company_name}',
    ],

    'bill_recur_admin' => [
        'subject'       => '{bill_number} recibo recurrente creado',
        'body'          => 'Hola,<br /><br /> Basado en el círculo recurrente de {vendor_name}, el recibo <strong>{bill_number}</strong> ha sido creado automáticamente.<br /><br />Puedes ver los detalles del recibo desde el siguiente enlace: <a href="{bill_admin_link}">{bill_number}</a>.<br /><br />Saludos cordiales,<br />{company_name}',
    ],

    'revenue_new_customer' => [
        'subject'       => 'Pago de {revenue_date} creado',
        'body'          => 'Apreciado {customer_name},<br /><br />Hemos preparado el siguiente pago. <br /><br />Puede ver los detalles del pago en el siguiente enlace: <a href="{revenue_guest_link}">{revenue_date}</a>.<br /><br />No dude en contactarnos si tiene alguna inquietud.<br /><br />Cordialmente,<br />{company_name}',
    ],

    'payment_new_vendor' => [
        'subject'       => 'Pago de {revenue_date} creado',
        'body'          => 'Apreciado {vendor_name},<br /><br />Hemos preparado el siguiente pago. <br /><br />Puede ver los detalles del pago en el siguiente enlace: <a href="{payment_admin_link}">{payment_date}</a>.<br /><br />No dude en contactarnos si tiene alguna inquietud.<br /><br />Cordialmente,<br />{company_name}',
    ],
];
