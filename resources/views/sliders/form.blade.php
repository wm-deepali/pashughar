<div class="mb-3 form-group">
    <label class="form-label">Title</label>
    <input type="text" 
           name="title" 
           class="form-control @error('title') is-invalid @enderror"
           value="{{ old('title', $slider->title ?? '') }}"
           required>
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3 form-group">
    <label class="form-label">Mobile Image</label>
    <input type="file" 
           name="mobile_image" 
           class="form-control @error('mobile_image') is-invalid @enderror">
    @error('mobile_image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @isset($slider)
        @if($slider->mobile_image)
            <img src="{{ asset('storage/'.$slider->mobile_image) }}" 
                 width="120" 
                 class="mt-2">
        @endif
    @endisset
</div>

<div class="mb-3 form-group">
    <label class="form-label">Desktop Image</label>
    <input type="file" 
           name="desktop_image" 
           class="form-control @error('desktop_image') is-invalid @enderror">
    @error('desktop_image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @isset($slider)
        @if($slider->desktop_image)
            <img src="{{ asset('storage/'.$slider->desktop_image) }}" 
                 width="180" 
                 class="mt-2">
        @endif
    @endisset
</div>

<div class="mb-3 form-group">
    <label class="form-label">Status</label>
    <select name="status" 
            class="form-select @error('status') is-invalid @enderror"
            required>
        <option value="1" 
            {{ old('status', $slider->status ?? 1) == 1 ? 'selected' : '' }}>
            Active
        </option>
        <option value="0" 
            {{ old('status', $slider->status ?? 1) == 0 ? 'selected' : '' }}>
            Inactive
        </option>
    </select>
    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>