
function confirmDelete(id) {
        const modal = document.getElementById('deleteModal');
        const confirmBtn = document.getElementById('confirmDeleteBtn');

        confirmBtn.setAttribute('href', 'delete.php?id=' + id);

        $('#deleteModal').modal('show');
}
      