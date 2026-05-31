<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualización de pedido</title>
</head>

<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:20px; color:#111;">

<div style="max-width:700px; margin:auto; background:white; padding:28px; border-radius:14px;">

    <h1 style="color:#d4a017; margin-bottom:8px;">
        Viajes Pa Pobres
    </h1>

    <p style="font-size:16px;">
        Hola {{ $order->user->name }},
    </p>

    <p style="font-size:16px;">
        Te informamos sobre el estado de tu pedido.
    </p>

    <div style="margin:24px 0; padding:18px; background:#f8f8f8; border-radius:10px;">
        <h2 style="margin:0 0 10px 0;">
            Pedido #{{ $order->id }}
        </h2>

        <p style="margin:6px 0;">
            <strong>Estado:</strong> {{ ucfirst($order->status) }}
        </p>

        <p style="margin:6px 0;">
            <strong>Fecha:</strong> {{ $order->created_at->format('d/m/Y H:i') }}
        </p>

        <p style="margin:6px 0;">
            <strong>Total:</strong> {{ number_format($order->total, 2) }} €
        </p>
    </div>

    <h3 style="margin-top:28px; margin-bottom:12px;">
        Detalle del pedido
    </h3>

    <table style="width:100%; border-collapse:collapse; margin-top:10px;">
        <thead>
            <tr style="background:#222; color:white;">
                <th style="padding:12px; text-align:left;">Producto</th>
                <th style="padding:12px; text-align:center;">Cantidad</th>
                <th style="padding:12px; text-align:right;">Precio unidad</th>
                <th style="padding:12px; text-align:right;">Subtotal</th>
            </tr>
        </thead>

        <tbody>
            @foreach($order->items as $item)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:12px;">
                        {{ $item->product->name ?? 'Producto eliminado' }}
                    </td>

                    <td style="padding:12px; text-align:center;">
                        {{ $item->quantity }}
                    </td>

                    <td style="padding:12px; text-align:right;">
                        {{ number_format($item->unit_price, 2) }} €
                    </td>

                    <td style="padding:12px; text-align:right;">
                        {{ number_format($item->subtotal, 2) }} €
                    </td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <td colspan="3" style="padding:14px; text-align:right; font-weight:bold;">
                    Total
                </td>

                <td style="padding:14px; text-align:right; font-weight:bold; color:#d4a017;">
                    {{ number_format($order->total, 2) }} €
                </td>
            </tr>
        </tfoot>
    </table>

    <p style="margin-top:28px;">
        Puedes consultar tus pedidos entrando en tu cuenta de Viajes Pa Pobres.
    </p>

    <p>
        Gracias por confiar en nosotros.
    </p>

</div>

</body>
</html>