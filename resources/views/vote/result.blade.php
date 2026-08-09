@extends('layouts.app')

@section('title', 'Election Results')

@section('content')

<h3 class="text-center mb-4">
    @if(isset($election) && $election)
        {{ $election->title }} - Results
    @else
        Election Results
    @endif
</h3>

@if($candidates->count() > 0)
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow p-3">
                <canvas id="resultChart" height="300"></canvas>
            </div>
        </div>
    </div>

    <div class="row mt-4 g-3 justify-content-center">
        @foreach($candidates as $index => $candidate)
            <div class="col-md-4">
                <div class="card text-center shadow-sm {{ $index == 0 ? 'border-success border-2' : '' }}">
                    <div class="card-body">
                        @if($index == 0)
                            <span class="badge bg-success mb-2">🏆 Leading</span>
                        @endif
                        <h5>{{ $candidate->name }}</h5>
                        <p class="text-muted small">{{ $candidate->department }}</p>
                        <h4 class="text-primary">{{ $candidate->votes_count }} votes</h4>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p class="text-center text-muted">No results to display yet.</p>
@endif

<script>
const ctx = document.getElementById('resultChart')?.getContext('2d');

if (ctx) {
    const labels = {!! json_encode($candidates->pluck('name')) !!};
    const votes = {!! json_encode($candidates->pluck('votes_count')) !!};
    const colors = ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#6f42c1', '#20c997'];

    const maxVotes = Math.max(...votes, 1);
    const chartWidth = ctx.canvas.width;
    const chartHeight = ctx.canvas.height;
    const barWidth = chartWidth / labels.length * 0.6;
    const gap = chartWidth / labels.length;

    ctx.clearRect(0, 0, chartWidth, chartHeight);

    labels.forEach((label, i) => {
        const barHeight = (votes[i] / maxVotes) * (chartHeight - 60);
        const x = i * gap + (gap - barWidth) / 2;
        const y = chartHeight - barHeight - 30;

        ctx.fillStyle = colors[i % colors.length];
        ctx.fillRect(x, y, barWidth, barHeight);

        ctx.fillStyle = '#000';
        ctx.font = '14px Arial';
        ctx.textAlign = 'center';
        ctx.fillText(votes[i], x + barWidth / 2, y - 8);

        ctx.font = '12px Arial';
        ctx.fillText(label, x + barWidth / 2, chartHeight - 10);
    });
}
</script>
@endsection