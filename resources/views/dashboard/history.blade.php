@extends('layouts.app')

@section('content')
<div class="row w-100 max-w-100 fade-in">
    <div class="col-12">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 pb-2 border-bottom border-light">
            <div class="d-flex align-items-center mb-3 mb-sm-0">
                <div>
                    <h4 class="fw-bolder m-0 text-dark fs-5">{{ __('Content Library') }}</h4>
                    <p class="text-secondary fw-medium m-0 mt-1 small">{{ __('Your complete historical archive of generated assets.') }}</p>
                </div>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-primary px-4 py-2 shadow-sm rounded-lg fw-bolder d-inline-flex align-items-center">
                <i data-lucide="plus" class="me-2 w-4 h-4"></i> {{ __('Create Copy') }}
            </a>
        </div>
        
        @if($contents->count() > 0)
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-3">
                @foreach($contents as $content)
                    <div class="col">
                        <div class="card card-hover h-100 bg-white">
                            <div class="card-body p-3 d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="d-flex align-items-center bg-light border px-2 py-1 rounded-sm">
                                        <i data-lucide="file-text" class="text-secondary me-1" style="width: 12px; height: 12px;"></i>
                                        <span class="text-uppercase fw-bolder text-dark" style="font-size: 0.65rem; letter-spacing: 0.5px;">
                                            {{ __($content->input_data['content_type'] ?? 'Copy') }}
                                        </span>
                                    </div>
                                    <small class="text-muted fw-bold d-flex align-items-center" style="font-size: 0.7rem;">
                                        <i data-lucide="clock" class="me-1 w-3 h-3 opacity-50"></i> {{ $content->created_at->diffForHumans() }}
                                    </small>
                                </div>
                                
                                <h6 class="fw-bold text-dark mb-2 text-truncate" title="{{ current($content->input_data) }}">
                                    {{ current($content->input_data) }}
                                </h6>
                                
                                <div class="flex-grow-1">
                                    <p class="card-text text-secondary mb-0 fw-medium" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.5; font-size: 0.85rem;">
                                        {{ $content->generated_text }}
                                    </p>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top border-light">
                                    <button class="btn btn-sm btn-outline-primary fw-bolder py-1 d-flex align-items-center" onclick="copyToClipboard(`{{ addslashes($content->generated_text) }}`)">
                                        <i data-lucide="copy" class="me-1 w-3 h-3"></i> {{ __('Copy Text') }}
                                    </button>
                                    
                                    <form action="{{ route('history.destroy', $content) }}" method="POST" onsubmit="return confirm('{{ __('Erase this record from the cloud forever?') }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm text-danger bg-transparent p-1 border-0 hover-opacity opacity-75 d-flex align-items-center" title="Delete record">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $contents->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="border-0 mt-3 mx-auto fade-in" style="max-width: 600px;">
                <div class="p-4 p-md-5 text-center" style="border: 2px dashed rgba(99,102,241, 0.2); border-radius: 12px;">
                    <div class="bg-primary bg-opacity-10 d-inline-block p-3 rounded-circle mb-3">
                        <i data-lucide="folder-open" class="text-primary w-8 h-8"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">{{ __('Library is Empty') }}</h5>
                    <p class="text-secondary small fw-medium mx-auto mb-4" style="max-width: 400px; line-height: 1.6;">
                        {{ __('Assets you generate will appear here for safekeeping.') }}
                    </p>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary px-4 py-2 shadow-sm fw-bolder rounded-lg d-inline-flex align-items-center">
                        <i data-lucide="sparkles" class="w-4 h-4 me-2"></i> {{ __('Go Generate') }}
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
