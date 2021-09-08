function init() {
    $.post(
        "admin/core/core.php",
        {
            "action": "init"
        },
        showGoods
    ).done(function () {
        selectGoods();
    }
    ).fail(function () {
        console.log('что-то пошло не так');
    })
}

function showGoods(data) {
    data = JSON.parse(data);
    var out = `<select> <option data-id="0" >Новый товар
        </option>`;
    for (var id in data) {
        out += `<option data-id="${id}">
            ${data[id].name}
        </option>`;
    }
    out += `</select>`;
    $('.goods-out').html(out);
    $('.goods-out select').on('change', selectGoods);
}

function selectGoods() {
    var id = $('.goods-out select option:selected').attr('data-id');
    if (id != 0) {
        $.post(
            "admin/core/core.php",
            {
                "action": "selectOneGood",
                'gid': id
            },
            function (data) {
                data = JSON.parse(data);
                $('#gname').val(data.name);
                $('#gcost').val(data.cost);
                $('#gdescr').val(data.description);
                $('#gimg').val(data.img);
                $('#gord').val(data.ord);
                $('#gid').val(data.id);
            }
        );
    } else {
        $('#gname').val('');
        $('#gcost').val('');
        $('#gdescr').val('');
        $('#gimg').val('');
        $('#gord').val('');
        $('#gid').val(id);
    }
}
function deleteGoods() {
    var id = $('#gid').val();
    if (id != "") {
        $.post(
            "admin/core/core.php",
            {
                "action": "deleteGoods",
                "id": id
            },
            function (data) {
                if (data == 1) {
                    alert('Запись удалена');
                    init();
                }
                else {
                    console.log(data);
                }
            }
        )
    }
    else {
        console.log(data);
    }
}
function saveToDb() {
    var id = $('#gid').val();
    if (id != undefined) {
        $.post(
            "admin/core/core.php",
            {
                "action": "updateGood",
                'gid': id,
                "gname": $('#gname').val(),
                "gcost": $('#gcost').val(),
                "gdescr": $('#gdescr').val(),
                "gimg": $('#gimg').val(),
                "gord": $('#gord').val()
            }).done(function () {
                alert('Запись сохранена');
                init();
                $.post(
                    "admin/core/core.php",
                    {
                        "action": "writeJSON"
                    }).done(function () {
                        console.log('Запись в json сохранена');
                    }).fail(function () {
                        console.log('что-то пошло не так в json');
                    })

            }
            ).fail(function () {
                console.log('что-то пошло не так');
            })
    }
}


$(document).ready(function () {
    init();
    $('.add-to-db').on('click', saveToDb);
    $('.delete-from-db').on('click', deleteGoods);
});