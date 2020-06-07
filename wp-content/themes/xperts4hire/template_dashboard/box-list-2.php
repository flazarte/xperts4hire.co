<?php 

$id = um_profile_id();
$work_history = select_work_history_user($id);
?>
<div class="boxed-list margin-bottom-60">
				<div class="boxed-list-headline">
					<h3><i class="icon-material-outline-business"></i> Employment History</h3>
				</div>
				<ul class="boxed-list-ul">
				<?php if(!empty($work_history)) :?>
					<?php if(count($work_history) > 0) :
						foreach ($work_history as $history) :
							$end_date = (strtotime($history['end_date']) > 0) ?  date('j F Y', strtotime($history['end_date'])) : 'Present';	
						?>
						<li>
							<div class="boxed-list-item">
								<!-- Avatar -->
								<div class="item-image">
									<img src=<?php echo 'data:image;base64,'.$history["company_image"].'' ?> alt="<?php echo  $history['company'];?>">
								</div>
								
								<!-- Content -->
								<div class="item-content">
									<h4><?php echo  strtoupper(htmlspecialchars_decode($history['position']));?></h4>
									<div class="item-details margin-top-7">
										<div class="detail-item"><a href="#"><i class="icon-material-outline-business"></i><?php echo  strtoupper(htmlspecialchars_decode($history['company']));?></a></div>
										<div class="detail-item"><i class="icon-material-outline-date-range"></i><?php echo date('j F Y', strtotime($history['start_date']));?> - <?php echo $end_date;?></div>
									</div>
									<div class="item-description">
										<p><?php echo htmlspecialchars_decode($history['job_description']);?></p>
									</div>
								</div>
							</div>
						</li>
						<?php endforeach;?>
					<?php endif;?>
				<?php else : ?>
				    <li>
						<p>Work history not available!</p>
					</li>					
				<?php endif;?>
				</ul>
			</div>