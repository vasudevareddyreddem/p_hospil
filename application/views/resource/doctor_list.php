

<?php echo '<pre>';print_r($details); ?> 
<?php foreach($details as $list){ ?>
</option value="<?php echo $list['t_d_doc_id']; ?>"><?php echo $list['resource_name']; ?></option>
<?php } ?>