<?php
$days_count = date('t');
$current_day = date('d');
$week_day_first = date('N', mktime(0, 0, 0, date('m'), 1, date('Y')));
?>
 
<table>
    <tr>
        <th>MO</th>
        <th>TU</th>
        <th>WE</th>
        <th>TH</th>
        <th>FR</th>
        <th style="color: red;">SU</th>
        <th style="color: red;">SA</th>
    </tr>
    <?php for ($w = 1 - $week_day_first + 1; $w <= $days_count; $w = $w + 7): ?>
        <tr>
            <?php $counter = 0; ?>
            <?php for ($d = $w; $d <= $w + 6; $d++): ?>
                <td style="<?php if ($counter > 4): ?>color: red;<?php endif; ?><?php if ($current_day == $d): ?>background-color:yellow; color:green;font-weight:bold;<?php endif; ?>">
                    <?php echo($d > 0 ? ($d > $days_count ? '' : $d) : '') ?>
                </td>
                <?php $counter++; ?>
            <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</table>