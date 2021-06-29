<div>
    <a href="{{ route('dashboard.admins.edit', $id) }}" class="btn btn-secondary">
        <i class="fas fa-edit"></i>
        <span>Edit</span>
    </a>
    <button data-url="{{ route('dashboard.admins.destroy', $id) }}" class="btn btn-danger"
        onclick="deleteAdmin(this)">
        <i class="fas fa-trash-alt"></i>
        <span>Delete</span>
    </button>

</div>
