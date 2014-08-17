<h2>My Projects</h2>
<hr/>
<div class="row">
    <table class="table">
        <thead>
        <tr>
            <td>Project Name</td>
            <td>Project Date</td>
            <td>&nbsp;</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach($projects as $project) : ?>
            <tr>
                <td><?php echo $project->name; ?></td>
                <td><?php echo date("dS M Y", strtotime($project->timstamp)); ?></td>
                <td><a href='<?php echo site_url('project/view/'.$project->id); ?>' class="btn btn-primary">Open Project</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>