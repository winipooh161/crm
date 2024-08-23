document.querySelectorAll('.toggle-project-info').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const projectInfoBlock = document.querySelector('.projectshow__body__allblocks');
        projectInfoBlock.classList.toggle('active');
    });
});
