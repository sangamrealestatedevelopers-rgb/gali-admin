@extends('administrator.layout.administrator')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Terms &amp; Conditions</h6>
                </div>
                <div class="pull-right">
                    <a href="{{ url('/term-conditions') }}" class="btn btn-default btn-sm" target="_blank" rel="noopener">View public page</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <form method="post" action="{{ route('admin_terms_conditions_update') }}" class="form-horizontal">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-md-2">Title<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="title" class="form-control" required maxlength="500"
                                       value="{{ old('title', $page->title ?? 'Terms & Conditions') }}"
                                       placeholder="Page heading">
                                <div class="text-danger">{{ $errors->first('title') }}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Content<span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <textarea name="body_html" id="body_html" class="form-control" rows="18" required
                                          placeholder="Full terms content (HTML)">{{ old('body_html', $page->body_html ?? '') }}</textarea>
                                <div class="text-danger">{{ $errors->first('body_html') }}</div>
                                <p class="help-block text-muted mb-0">Stored in MongoDB collection <code>comx_cms_pages</code> (<code>page_key</code> = terms_conditions).</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-8">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    if (typeof CKEDITOR !== 'undefined') {
        CKEDITOR.replace('body_html', { height: 400 });
    }
</script>
@endpush
