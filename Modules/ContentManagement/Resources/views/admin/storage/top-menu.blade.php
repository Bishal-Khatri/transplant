<div class="btn-group">
    <a href="{{ route('cms.storage.index') }}" class="btn btn-secondary btn-sm {{ Route::current()->getName() == 'cms.storage.index' ? 'active' : '' }}" type="button">All Files</a>
    <a href="{{ route('cms.storage.gallery.index') }}" class="btn btn-secondary btn-sm {{ Route::current()->getName() == 'cms.storage.gallery.index' ? 'active' : '' }}" type="button">Gallery</a>
</div>
