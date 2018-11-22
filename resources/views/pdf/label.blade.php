<style>
    .label-climb-grade {
        font-size: 60px;
        margin: 0;
    }

    .label-climb-grade small {
        font-size: 24px;
    }

    .label-climb-name {
        font-size: 36px;
        color: #aaa;
        margin: 0;
    }

    .label-climb-setter {
        margin: 0;
    }

    .label-climb-id {
        font-size: 12px;
        color: #ddd;
    }

    .left, .right {
        display: inline-block;
        width: 50%;
        float: left;
    }
</style>

<table>
    <tr>
        <td>
            <img src="<?php echo $this->getQRCodeURL(); ?>" />
        </td>
        <td>
            <h1 class="label-climb-grade"><?php echo $this->grade; ?></h1>
            <h2 class="label-climb-name"><?php echo $this->name; ?></h2>
            <h3 class="label-climb-setter">Setter: <?php echo $this->setter_id; ?></h3>
            <p class="label-climb-id">Climb #<?php echo $this->id; ?></p>
        </td>
    </tr>
</table>