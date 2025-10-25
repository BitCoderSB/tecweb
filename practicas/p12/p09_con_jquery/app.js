// JSON base
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

function init() {
    $("#description").val(JSON.stringify(baseJSON, null, 2));
    listar();
    bindUI();
}

function bindUI() {
    // Buscar
    $("#search-form").on("submit", e => { 
        e.preventDefault(); 
        buscar($("#search").val()); 
    });
    $("#search").on("keyup", () => buscar($("#search").val()));

    // Guardar (insert/update)
    $("#product-form").on("submit", e => {
        e.preventDefault();
        const nombre = $("#name").val().trim();
        if (!nombre) { 
            alert("Nombre requerido"); 
            return; 
        }
        let data;
        try { 
            data = JSON.parse($("#description").val()); 
        } catch { 
            alert("JSON inválido"); 
            return; 
        }
        data.nombre = nombre;
        const id = $("#productId").val().trim();
        if (id) data.id = Number(id);

        $.ajax({
            url: "./backend/product-add.php",
            method: "POST",
            data: JSON.stringify(data),
            contentType: "application/json; charset=UTF-8",
            success: resp => {
                const r = typeof resp === "string" ? JSON.parse(resp) : resp;
                barra(`status: ${r.status}`, `message: ${r.message}`);
                listar();
                if (!id) resetForm();
            }
        });
    });

    // Nuevo
    $("#new-btn").on("click", resetForm);

    // Delegación: eliminar
    $("#products").on("click", ".btn-del", function() {
        const id = $(this).closest("tr").data("id");
        if (!confirm("¿Eliminar?")) return;
        $.get("./backend/product-delete.php", {id}, resp => {
            const r = typeof resp === "string" ? JSON.parse(resp) : resp;
            barra(`status: ${r.status}`, `message: ${r.message}`);
            listar();
            if ($("#productId").val() == String(id)) resetForm();
        });
    });

    // Delegación: editar → cargar al formulario
    $("#products").on("click", ".btn-edit", function() {
        const tr = $(this).closest("tr");
        const id = tr.data("id");
        const nombre = tr.find("td:eq(1)").text().trim();
        const desc = {};
        tr.find("td:eq(2) li").each(function() {
            const [k, v] = $(this).text().split(":");
            const key = k.trim(); 
            const val = v?.trim() ?? "";
            desc[key] = (key === "precio" || key === "unidades") ? Number(val) : val;
        });
        $("#productId").val(id);
        $("#name").val(nombre);
        $("#description").val(JSON.stringify(desc, null, 2));
        $("#save-btn").text("Guardar cambios");
    });
}

// Listar
function listar() {
    $.get("./backend/product-list.php", data => {
        const productos = typeof data === "string" ? JSON.parse(data) : data;
        renderTabla(productos);
    });
}

// Buscar
function buscar(q) {
    if (!q) { 
        listar(); 
        $("#product-result").addClass("d-none"); 
        return; 
    }
    $.get("./backend/product-search.php", {search: q}, data => {
        const productos = typeof data === "string" ? JSON.parse(data) : data;
        renderTabla(productos);
        $("#product-result").removeClass("d-none");
        $("#container").html(productos.map(p => `<li>${p.nombre}</li>`).join(""));
    });
}

// Render
function renderTabla(arr) {
    const rows = (arr || []).map(p => {
        const d = `
            <li>precio: ${p.precio}</li>
            <li>unidades: ${p.unidades}</li>
            <li>modelo: ${p.modelo}</li>
            <li>marca: ${p.marca}</li>
            <li>detalles: ${p.detalles}</li>`;
        return `
            <tr data-id="${p.id}">
                <td>${p.id}</td>
                <td>${p.nombre}</td>
                <td><ul>${d}</ul></td>
                <td class="text-nowrap">
                    <button type="button" class="btn btn-warning btn-sm btn-edit">Editar</button>
                    <button type="button" class="btn btn-danger btn-sm btn-del">Eliminar</button>
                </td>
            </tr>`;
    }).join("");
    $("#products").html(rows);
}

// Barra de estado
function barra(...lines) {
    $("#product-result").removeClass("d-none");
    $("#container").html(lines.map(t => `<li style="list-style:none;">${t}</li>`).join(""));
}

// Reset form
function resetForm() {
    $("#productId").val("");
    $("#name").val("");
    $("#description").val(JSON.stringify(baseJSON, null, 2));
    $("#save-btn").text("Agregar Producto");
}

$(init);
