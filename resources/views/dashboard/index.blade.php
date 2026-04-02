@extends('layouts.app')

@section('content')
<div class="row fade-in h-xl-100 g-3">
    <div class="col-lg-12 col-xl-6 mb-4 mb-xl-0">
        <div class="card border-0 position-relative h-100">
            
            <div id="loadingOverlay" class="lock-screen mt-0">
                <div class="spinner-border text-primary mb-3" style="width: 2.5rem; height: 2.5rem;" role="status"></div>
                <h6 class="fw-bolder text-dark mb-1 fs-5">{{ __('Generating Context...') }}</h6>
                <p class="text-secondary small fw-medium m-0 opacity-75">{{ __('Processing parameters securely.') }}</p>
            </div>

            <div class="card-body p-4 p-md-4 px-xl-5 py-xl-4 d-flex flex-column gap-2">
                <div class="mb-4 d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3 flex-shrink-0" style="border: 1px solid rgba(99,102,241,0.15);">
                        <i data-lucide="zap" class="text-primary w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="fw-bolder mb-0 text-dark fs-5">{{ __('Generation Engine') }}</h4>
                        <p class="text-muted small fw-medium m-0 mt-1">{{ __('Specify parameters for the AI model.') }}</p>
                    </div>
                </div>
                
                <form id="generateForm" method="POST" action="{{ route('generate') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="product_name" class="form-label small fw-bolder text-uppercase d-flex justify-content-between">
                            <span>{{ __('Product / Idea Name') }} <span class="text-danger">*</span></span>
                        </label>
                        <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" value="{{ old('product_name') }}" placeholder="{{ __('What are you offering?') }}">
                        @error('product_name') <div class="invalid-feedback small fw-medium mt-1"><i data-lucide="alert-circle" class="w-3 h-3 me-1"></i>{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label small fw-bolder text-uppercase d-flex justify-content-between">
                            <span>{{ __('Key Value Proposition') }}</span>
                        </label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="2" placeholder="{{ __('Describe the single biggest advantage of the product...') }}">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback small fw-medium mt-1"><i data-lucide="alert-circle" class="w-3 h-3 me-1"></i>{{ $message }}</div> @enderror
                    </div>

                    <div class="row mb-3 g-2">
                        <div class="col-md-6">
                            <label for="audience" class="form-label small fw-bolder text-uppercase d-flex justify-content-between">
                                <span>{{ __('Core Audience') }}</span>
                            </label>
                            <input type="text" class="form-control @error('audience') is-invalid @enderror" id="audience" name="audience" value="{{ old('audience') }}" placeholder="{{ __('e.g. Agency Owners') }}">
                            @error('audience') <div class="invalid-feedback small fw-medium mt-1"><i data-lucide="alert-circle" class="w-3 h-3 me-1"></i>{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="tone" class="form-label small fw-bolder text-uppercase d-flex justify-content-between">
                                <span>{{ __('Voice & Tone') }} <span class="text-danger">*</span></span>
                            </label>
                            <select class="form-select @error('tone') is-invalid @enderror" id="tone" name="tone">
                                <option value="professional" @selected(old('tone') == 'professional')>{{ __('Professional') }}</option>
                                <option value="casual" @selected(old('tone') == 'casual')>{{ __('Casual & Fun') }}</option>
                                <option value="persuasive" @selected(old('tone') == 'persuasive')>{{ __('High Conviction (Ads)') }}</option>
                            </select>
                            @error('tone') <div class="invalid-feedback small fw-medium mt-1"><i data-lucide="alert-circle" class="w-3 h-3 me-1"></i>{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="content_type" class="form-label small fw-bolder text-uppercase d-flex justify-content-between">
                            <span>{{ __('Output Format Requirement') }} <span class="text-danger">*</span></span>
                        </label>
                        <select class="form-select @error('content_type') is-invalid @enderror" id="content_type" name="content_type">
                            <option value="Ads" @selected(old('content_type') == 'Ads')>{{ __('B2B High Intent Ad Copy') }}</option>
                            <option value="Product Description" @selected(old('content_type') == 'Product Description')>{{ __('Product Details Page') }}</option>
                            <option value="Social Media Caption" @selected(old('content_type') == 'Social Media Caption')>{{ __('Social Growth Caption') }}</option>
                        </select>
                        @error('content_type') <div class="invalid-feedback small fw-medium mt-2"><i data-lucide="alert-circle" class="w-3 h-3 me-1"></i>{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" id="generateBtn" class="btn btn-primary w-100 py-3 mt-1 d-flex justify-content-center align-items-center">
                        <span class="fs-6 fw-bold me-2">{{ __('Launch Generation') }}</span>
                        <i data-lucide="sparkles" class="w-5 h-5"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-xl-6 d-flex flex-column h-xl-100">
        @if(session('generated_content'))
            <div class="card border-0 shadow-sm fade-in h-100 position-relative" style="border: 1px solid rgba(99, 102, 241, 0.2) !important;">
                
                <div class="position-absolute top-0 start-0 w-100 bg-primary bg-opacity-10 py-1" style="height: 6px; border-radius: 12px 12px 0 0;"></div>
                
                <div class="card-body p-4 p-xl-5 d-flex flex-column h-100">
                    
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 text-success p-2 rounded-circle me-3">
                                <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h5 class="fw-bolder m-0 text-dark">{{ __('Optimization Complete') }}</h5>
                                <p class="text-secondary small fw-medium m-0 mt-1">{{ __('Output has been natively saved to library vault.') }}</p>
                            </div>
                        </div>
                        
                        <button class="btn btn-primary btn-sm px-4 fw-bolder d-flex align-items-center rounded-pill shadow-sm" onclick="copyToClipboard(`{{ addslashes(session('generated_content')->generated_text) }}`)" title="{{ __('Copy') }}">
                            <i data-lucide="copy" class="w-4 h-4 me-2"></i> {{ __('Copy To Clipboard') }}
                        </button>
                    </div>
                    
                    <div class="rounded-3 flex-grow-1 position-relative mt-2" style="background:#F8FAFC; border: 1px solid #E2E8F0; padding: 1.5rem;">
                        <i data-lucide="quote" class="position-absolute text-secondary opacity-25 top-0 start-0 mt-3 ms-3" style="width:48px; height:48px;"></i>
                        <p class="mb-0 lh-lg text-dark fw-medium position-relative z-1" style="font-size: 1.05rem;">
                            {{ session('generated_content')->generated_text }}
                        </p>
                    </div>
                </div>
            </div>
        @else
            <div class="card border-0 fade-in h-100 bg-transparent flex-row align-items-center justify-content-center" style="border: 2px dashed rgba(99,102,241, 0.2) !important;">
                <div class="d-flex flex-column align-items-center text-center p-4 p-md-5">
                    <div class="position-relative mb-4">
                        <div class="bg-white border rounded-circle d-flex align-items-center justify-content-center shadow-sm position-relative" style="width: 80px; height: 80px; border-color: rgba(99,102,241, 0.15) !important;">
                            <i data-lucide="workflow" class="text-primary" style="width: 40px; height: 40px;"></i>
                        </div>
                    </div>
                    <h4 class="fw-bolder text-dark mb-2">{{ __('Engine is Idle') }}</h4>
                    <p class="text-secondary fw-medium lead mx-auto" style="max-width: 350px; font-size: 0.95rem; line-height: 1.6;">
                        {{ __('Select parameters on the adjacent panel to initialize standard generation protocols. Output will stream directly here.') }}
                    </p>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    document.getElementById('generateForm').addEventListener('submit', function() {
        const btn = document.getElementById('generateBtn');
        const overlay = document.getElementById('loadingOverlay');
        
        btn.classList.add('disabled', 'opacity-75');
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> <span class="fw-bold fs-6">{{ __('Compiling Pattern...') }}</span>';
        
        overlay.classList.add('active');
    });
</script>
@endsection
