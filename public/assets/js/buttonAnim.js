document.addEventListener('DOMContentLoaded', function() {
    var listViewBtn = document.getElementById('listViewBtn');
    var blockViewBtn = document.getElementById('blockViewBtn');
    var listViewBtnSVG = document.getElementById('listViewBtnSVG');
    var blockViewBtnSVG = document.getElementById('blockViewBtnSVG');
    var listViewProjects = document.querySelector('.projects__lists');
    var blockViewProjects = document.querySelector('.projects__block__lists');

    listViewBtn.addEventListener('click', function() {
        listViewProjects.style.display = 'flex';
        blockViewProjects.style.display = 'none';
        blockViewBtnSVG.querySelectorAll('rect').forEach(rect => {
            rect.setAttribute('fill', '#8E9397'); // Цвет для неактивной кнопки
        });
        listViewBtnSVG.querySelectorAll('rect').forEach(rect => {
            rect.setAttribute('fill', '#007bff'); // Цвет для активной кнопки
        });
    });

    blockViewBtn.addEventListener('click', function() {
        listViewProjects.style.display = 'none';
        blockViewProjects.style.display = 'flex';
        blockViewBtnSVG.querySelectorAll('rect').forEach(rect => {
            rect.setAttribute('fill', '#007bff'); // Цвет для активной кнопки
        });
        listViewBtnSVG.querySelectorAll('rect').forEach(rect => {
            rect.setAttribute('fill', '#8E9397'); // Цвет для неактивной кнопки
        });
    });
    listViewBtnSVG.querySelectorAll('rect').forEach(rect => {
        rect.setAttribute('fill', '#007bff'); // Цвет для активной кнопки
    });
    // Изначально отображаем список
    listViewProjects.style.display = 'flex';
    blockViewProjects.style.display = 'none';
});