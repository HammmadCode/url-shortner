@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">URL Shortener</h2>
    
    <!-- URL Form -->
    <form action="{{ route('shorturl.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="row g-2">
            <div class="col-md-6">
                <input 
                    type="url" 
                    name="long_url" 
                    class="form-control" 
                    placeholder="Enter Long URL" 
                    required>
            </div>
            <div class="col-md-4">
                <input 
                    type="text" 
                    name="short_code" 
                    class="form-control" 
                    placeholder="Custom Short Code (optional)">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Create</button>
            </div>
        </div>
    </form>

    <!-- URL Table -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Short URL</th>
                    <th scope="col">Long URL</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($urls as $url)
                    <tr>
                        <td>
                            <a href="{{ route('short.redirect', $url->short_code) }}" class="text-primary">
                                {{ $url->short_code }}
                            </a>
                        </td>
                        <td>{{ $url->long_url }}</td>
                        <td>
                            <a href="{{ route('analytics.show', $url->id) }}" class="btn btn-sm btn-secondary">
                                View Analytics
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No URLs created yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
