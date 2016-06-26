<table class="table table-bordered table-striped data-info is-hide">
    <?php
        foreach ($attributes as $key => $value) :
            $str_alias = isset($alias[$key]) ? $alias[$key] : $key;
    ?>
    <tr>
        <td class="col-xs-3 text-right"><?= $value ?></td>
        <td class="col-xs-9 data-detail info-<?= $str_alias ?>"></td>
    </tr>
    <?php endforeach; ?>
</table>


