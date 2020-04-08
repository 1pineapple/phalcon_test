$(document).ready(() => {
    let first, previous, next, last, current;
    let intiTableRows = page => {
        $.ajax({
            url: '/users/list/table?page=' + page
        }).done(function (data) {
            console.log(data.roles.search('delete'));
            if (data.roles.search('create')!==-1) {
                $('.add-button').removeClass('d-none');
            }
            first = data.page.first;
            previous = data.page.previous;
            next = data.page.next;
            last = data.page.last;
            current = data.page.current;
            let tbl_body = "";
            let odd_even = false;
            $.each(data.page.items, (index, value) => {
                let tbl_row = "";
                tbl_row += "<td>" + value.id + "</td>";
                tbl_row += "<td>" + value.login + "</td>";
                tbl_row += "<td>" + value.roles + "</td>";
                tbl_row += "<td>" + value.created_at + "</td>";
                tbl_row += "<td>" + value.updated_at + "</td>";
                tbl_row += "<td>" +
                    (data.roles.search('update')!==-1 ? "<a href=\"/users/edit/" + value.id + "\" class=\"btn btn-primary mr-3\">Edit</a>" : "") +
                    (data.roles.search('delete')!==-1 ? "<button type=\"button\" id=\"" + value.id + "\" class=\"btn btn-danger delete\">Delete</button>" : "") +
                    "</td>";
                tbl_body += "<tr class=\"" + (odd_even ? "odd" : "even") + "\">" + tbl_row + "</tr>";
                odd_even = !odd_even;
            });
            $("#init-body-table").empty();
            $("#init-body-table").append(tbl_body);
        });
    };
    $("#next").on("click", e => {
        e.preventDefault();
        intiTableRows(next);
    });
    $("#previous").on("click", e => {
        e.preventDefault();
        intiTableRows(previous);
    });
    $("#first").on("click", e => {
        e.preventDefault();
        intiTableRows(first);
    });
    $("#last").on("click", e => {
        e.preventDefault();
        intiTableRows(last);
    });
    intiTableRows(1);
    $(document).on('click', '.delete', function () {
        $.ajax({
            method: "POST",
            url: "/users/delete",
            data: {id: $(this).attr('id')}
        }).done((data) => {
            intiTableRows(current);
        });
    });

});