@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Analytics Data</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">IP Address</th>
                    <th scope="col">User Agent</th>
                    <th scope="col">Location</th>
                    <th scope="col">Clicked At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($shortUrl->analytics as $data)
                    <tr>
                        <td>{{ $data->ip_address }}</td>
                        <td>{{ $data->user_agent }}</td>
                        <td>{{ $data->location }}</td>
                        <td>{{ $data->clicked_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No analytics data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
