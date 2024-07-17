function showRow(code) {
    // Remove a classe "active" de todas as linhas
    var rows = document.querySelectorAll("tbody tr");
    rows.forEach(function(row) {
        row.classList.remove("active");
    });

    // Adiciona a classe "active" apenas na linha com o código correspondente
    var selectedRow = document.querySelector("tbody tr[data-code='" + code + "']");
    if (selectedRow) {
        selectedRow.classList.add("active");
    }
}

// Mostrar todas as linhas por padrão em telas maiores
if (window.innerWidth > 768) {
    var rows = document.querySelectorAll("tbody tr");
    rows.forEach(function(row) {
        row.classList.add("active");
    });
} else {
    // Mostrar a primeira linha por padrão em telas menores
    showRow('001');
}

// Atualiza a visibilidade do seletor quando a janela é redimensionada
window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        document.getElementById('selectors').style.display = 'none';
        var rows = document.querySelectorAll("tbody tr");
        rows.forEach(function(row) {
            row.classList.add("active");
        });
    } else {
        document.getElementById('selectors').style.display = 'block';
        var rows = document.querySelectorAll("tbody tr");
        rows.forEach(function(row) {
            row.classList.remove("active");
        });
        showRow('001');
    }
});
