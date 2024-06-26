@if ($project->exists)
    <form action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data" method="POST">
        @method('PUT')
    @else
        <form action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" method="POST">
@endif

@CSRF
<div class="row">
    <div class="col-6">
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text"
                class="form-control @error('title') is-invalid @elseif(old('title', '')) is-valid @enderror"
                name="title" id="title" placeholder="Nome del progetto..."
                value="{{ old('title', $project->title) }}">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @else
                <div class="form-text">
                    Inserisci il titolo del progetto
                </div>
            @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug"
                value="{{ Str::slug(old('title', $project->title)) }}" disabled>
        </div>
    </div>
    <div class="col-12">
        <div class="mb-3">
            <label for="content" class="form-label">Descrizione del progetto</label>
            <textarea class="form-control @error('content') is-invalid @elseif(old('content', '')) is-valid @enderror"
                name="content" id="content" rows="20">
                    {{ old('content', $project->content) }}
                </textarea>
            @error('content')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @else
                <div class="form-text">
                    Inserisci una descrizione del progetto
                </div>
            @enderror
        </div>
    </div>
    <div class="col-5">
        <label for="category_id" class="form-label">Seleziona la categoria</label>
        <select name="category_id" id="category_id"
            class="form-select @error('category_id') is-invalid @elseif(old('category_id', '')) is-valid @enderror">
            <option value="">Nessuna</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if (old('category_id', $project->category?->id) == $category->id) selected @endif>
                    {{ $category->label }}</option>
            @endforeach
        </select>
        @error('category_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-6">
        <div>
            <label for="image" class="form-label">Immagine</label>
            <input type="file"
                class="form-control @error('image') is-invalid @elseif(old('image', '')) is-valid @enderror"
                name="image" id="image" placeholder="http:// o hattps://"
                value="{{ old('image', $project->image) }}">
        </div>
        @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @else
            <div class="form-text">
                Carica un file immagine
            </div>
        @enderror
    </div>
    <div class="col-1">
        <img src="{{ old('image', $project->image)
            ? $project->printImage()
            : 'https://marcolanci.it/boolean/assets/placeholder.png' }}"
            alt="{{ $project->image ? $project->slug : 'preview' }}" id="preview" class="img-fluid">
    </div>
    <div class="col-10">
        <div class="form-group @error('technologies') is-invalid @enderror">

            @foreach ($technologies as $technology)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="technologies[]"
                        id="{{ "technology-$technology->id" }}" value="{{ $technology->id }}"
                        @if (in_array($technology->id, old('technologies', $prev_technologies ?? []))) checked @endif>
                    <label class="form-check-label"
                        for="{{ "technology-$technology->id" }}">{{ $technology->label }}</label>
                </div>
            @endforeach
        </div>
        @error('technologies')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-2 d-flex justify-content-end">
        <div class="form-check  form-switch">
            <input class="form-check-input" type="checkbox" name="is_published" id="is_published" value="1"
                @if (old('is_published', $project->is_published)) checked @endif>
            <label class="form-check-label" for="is_published">
                Pubblicato
            </label>
        </div>
    </div>
</div>

<div class="d-flex align-items-center justify-content-between my-3">
    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Torna indietro</a>

    <div class="d-flex align-items-center gap-2">
        <button type="reset" class="btn btn-light"><i class="fa-solid fa-eraser"></i> Svuota i campi</button>
        <button type="submit" class="btn btn-primary "><i class="fas fa-floppy-disk me-2"></i>Salva</button>
    </div>
</div>
</form>
