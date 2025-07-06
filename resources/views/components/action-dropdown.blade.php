<div class="dropdown">
    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
        Aksi
    </button>
    <div class="dropdown-menu">
        <button class="dropdown-item btn-edit" data-toggle="modal" data-target="#editModal"
            data-email="{{ $itemEmail ?? '' }}" data-id="{{ $itemId }}" data-name="{{ $itemName ?? '' }}"
            data-phone="{{ $itemPhone ?? '' }}"  data-role="{{ $itemRole ?? '' }}">Edit</button>
        <button class="dropdown-item text-danger btn-delete" data-toggle="modal" data-target="#deleteModal"
            data-id="{{ $itemId }}" data-name="{{ $itemName ?? '' }}"
        >Hapus</button>
    </div>
</div>
