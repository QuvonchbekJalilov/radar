<a href="{{ route('order.show', $order->id) }}" class="btn btn-info btn-sm">Ko'rish</a>
<a href="{{ route('order.edit', $order->id) }}" class="btn btn-primary btn-sm">Tahrirlash</a>
<form action="{{ route('order.destroy', $order->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Buyurtmani o\'chirishga ishonchingiz komilmi?')">O'chirish</button>
</form>
