document.querySelectorAll('.pin-btn').forEach(btn =>{
    btn.addEventListener('click', async() =>{
        const noteId = btn.dataset.id;

        const res = await fetch(`/notes/${noteId}/toggle-pin`, {
            method: 'PUT',
            headers:{
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });

        const data = await res.json();
        if (res.ok) {
            btn.innerHTML = data.pinned
            ? '<i class="fi fi-rr-thumbtack"></i>'
            : '  <i class="fi fi-sr-thumbtack"></i>';
    } else {
        alert('Error al cambiar estado');
    }
});
});
