/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function () {
    $("#module_select_all").on("change", function () {
        $(".module_checkb").prop('checked', this.checked);
        $(".view_checkb").prop('checked', this.checked);
        $(".edit_checkb").prop('checked', this.checked)
        $(".create_checkb").prop('checked', this.checked);
        $(".delete_checkb").prop('checked', this.checked);
        $("#module_select_all").prop('checked', this.checked);
        $("#view_all").prop('checked', this.checked);
        $("#create_all").prop('checked', this.checked);
        $("#edit_all").prop('checked', this.checked);
        $("#delete_all").prop('checked', this.checked);
    });

    $(".module_checkb,  .view_checkb").on("change", function () {
        var val = $(this).attr("module_id");
        $("#module_" + val).prop('checked', this.checked)
        $("#module_view_" + val).prop('checked', this.checked);
        $("#module_create_" + val).prop('checked', this.checked)
        $("#module_edit_" + val).prop('checked', this.checked);
        $("#module_delete_" + val).prop('checked', this.checked);
    });

    $(".create_checkb,  .edit_checkb, .delete_checkb").on("change", function () {
        var val = $(this).attr("module_id");
        $(this).prop('checked', this.checked);
        if (!$("#module_" + val).is(':checked')) {
            $("#module_" + val).prop('checked', this.checked);
        }
        if (!$("#module_view_" + val).is(':checked')) {
            $("#module_view_" + val).prop('checked', this.checked);
        }
    });
    
    $("#view_all").on("change", function () {
        $(".view_checkb").prop('checked', this.checked);
        if ($('#view_all').is(':checked')) {
            $(".module_checkb").prop('checked', this.checked);
            $(".view_checkb").prop('checked', this.checked);
            $("#module_select_all").prop('checked', this.checked);
            $("#view_all").prop('checked', this.checked);
        }
    });

    $("#create_all").on("change", function () {
        $(".create_checkb").prop('checked', this.checked);
        if ($('#create_all').is(':checked')) {
            $(".module_checkb").prop('checked', this.checked);
            $(".view_checkb").prop('checked', this.checked);
            $("#module_select_all").prop('checked', this.checked);
            $("#view_all").prop('checked', this.checked);
        }
    });

    $("#edit_all").on("change", function () {
        $(".edit_checkb").prop('checked', this.checked);
        if ($('#edit_all').is(':checked')) {
            $(".module_checkb").prop('checked', this.checked);
            $(".view_checkb").prop('checked', this.checked);
            $("#module_select_all").prop('checked', this.checked);
            $("#view_all").prop('checked', this.checked);
        }
    });

    $("#delete_all").on("change", function () {
        $(".delete_checkb").prop('checked', this.checked);
        if ($('#delete_all').is(':checked')) {
            $(".module_checkb").prop('checked', this.checked);
            $(".view_checkb").prop('checked', this.checked);
            $("#module_select_all").prop('checked', this.checked);
            $("#view_all").prop('checked', this.checked);
        }
    });
    
    $("#provinsi_view_all").on("change", function () {
        $(".provinsi_view_checkb").prop('checked', this.checked);
        if ($('#provinsi_view_all').is(':checked')) {
            $(".provinsi_view_checkb").prop('checked', this.checked);
            $("#provinsi_view_all").prop('checked', this.checked);
        }
    });
    
    $("#sektor_view_all").on("change", function () {
        $(".sektor_view_checkb").prop('checked', this.checked);
        if ($('#sektor_view_all').is(':checked')) {
            $(".sektor_view_checkb").prop('checked', this.checked);
            $("#sektor_view_all").prop('checked', this.checked);
        }
    });
    
    $("#opd_view_all").on("change", function () {
        $(".opd_view_checkb").prop('checked', this.checked);
        if ($('#opd_view_all').is(':checked')) {
            $(".opd_view_checkb").prop('checked', this.checked);
            $("#opd_view_all").prop('checked', this.checked);
        }
    });
    
    $("#urusan_view_all").on("change", function () {
        $(".urusan_view_checkb").prop('checked', this.checked);
        if ($('#urusan_view_all').is(':checked')) {
            $(".urusan_view_checkb").prop('checked', this.checked);
            $("#urusan_view_all").prop('checked', this.checked);
        }
    });
    
    $("#suburusan_view_all").on("change", function () {
        $(".suburusan_view_checkb").prop('checked', this.checked);
        if ($('#suburusan_view_all').is(':checked')) {
            $(".suburusan_view_checkb").prop('checked', this.checked);
            $("#suburusan_view_all").prop('checked', this.checked);
        }
    });
});

