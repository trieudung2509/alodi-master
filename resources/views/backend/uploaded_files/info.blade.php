@php
    if($file->file_original_name == null){
        $file_name = translate('Unknown');
    }else{
        $file_name = $file->file_original_name;
    }
@endphp

<div>
    <form id="add_form" class="form-horizontal" action="{{ route('uploaded-files.update', $file->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label>{{ translate('File Name') }}</label>
            <input type="text" class="form-control bg-soft-dark" value="{{ $file->file_name }}" disabled>
        </div>
        <div class="form-group">
            <label>{{ translate('Alt Title') }}</label>
            <input id="file_original_name" type="text" class="form-control" name="file_original_name" value="{{ $file_name }}">
        </div>
        <div class="form-group">
            <label>{{ translate('File Type') }}</label>
            <input type="text" class="form-control bg-soft-dark" value="{{ $file->type }}" disabled>
        </div>
        <div class="form-group">
            <label>{{ translate('File Size') }}</label>
            <input type="text" class="form-control bg-soft-dark" value="{{ formatBytes($file->file_size) }}" disabled>
        </div>
        @if ($file->width != null)
            <div class="form-group">
                <label>{{ translate('Width') }}</label>
                <input type="text" class="form-control bg-soft-dark" value="{{ $file->width }}" disabled>
            </div>
        @endif
        @if ($file->height != null)
            <div class="form-group">
                <label>{{ translate('Height') }}</label>
                <input type="text" class="form-control bg-soft-dark" value="{{ $file->height }}" disabled>
            </div>
        @endif
        <div class="form-group">
            <label>{{ translate('Uploaded By') }}</label>
            <input type="text" class="form-control bg-soft-dark" value="{{ $file->user->name }}" disabled>
        </div>
        <div class="form-group">
            <label>{{ translate('Uploaded At') }}</label>
            <input type="text" class="form-control bg-soft-dark" value="{{ $file->created_at }}" disabled>
        </div>

        <div class="form-group text-center">
            <a class="btn btn-secondary" href="{{ my_asset($file->file_name) }}" target="_blank" download="{{ $file_name }}.{{ $file->extension }}">{{ translate('Download') }}</a>
            <button id="uploaded-file-submit" type="submit" class="btn btn-primary">
                {{translate('Save')}}
            </button>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#uploaded-file-submit').hide();
        $('#file_original_name').change(function () {
            $('#uploaded-file-submit').show();
        });
    });
</script>
