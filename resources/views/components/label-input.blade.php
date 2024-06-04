<div class="mb-3">
    <label class="form-label">{{ $label }}</label>
    <input type="text" class="form-control" value="{{ $value }}" aria-describedby="helpId" placeholder="{{ $placeholder }}" {{ $disabled == true ? "readonly" : "" }}>
</div>
