<?php include_once('style.php'); ?>

<div class="alek-index-box">
    <form class="interface" id="crud_form" method="GET">
        <table class="table table-striped" border="1">
            <tr>
                <td>
                    <a class="btn btn-default" href="/ci3/aleksandr_vashchenko_crud/add/">Add</a>
                    <a class="btn btn-danger del_btn">Del</a>
                </td>
                <td>
                    <input class="form-control search-box" type="text" name="search" value="" placeholder="Search..."/>
                    <input class="form-control table_page hidden" type="text" name="page" value="1"/>
                </td>
                <td>
                    Per Page:
                    <select name="per_page" id="alek-page-select" class="form-control"">
                    <option value="1">1</option>
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="all">all</option>
                    </select>
                </td>
            </tr>
        </table>
    </form>

    <!--table view renders here-->
    <div class="crud_table" id="crud_table"></div>

    <form class="interface" id="crud_form" method="GET">
        <table class="table table-striped table-controls" border="1">
            <tr>
                <td>
                    <a class="btn btn-secondary glyphicon glyphicon-menu-left page_left"></a>
                    <input class="form-control table_page" type="text" name="page" value="1" readonly/>
                    <input class="hidden" type="text"/>
                    <a class="btn btn-secondary glyphicon glyphicon-menu-right page_right"></a>
                </td>
            </tr>
        </table>
    </form>
</div>




