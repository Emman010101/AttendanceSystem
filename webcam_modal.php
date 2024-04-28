        <!-- webcam modal -->
        <div id="webcam_modal" class="modal fade" role="dialog">
            <input type="hidden" id="hidden_id" name="id"></input>
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
                        <div id="my_camera"></div>
						<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal" onclick="Webcam.reset()">Close</a>
							<button type="submit" class="btn btn-primary" onclick="take_snapshot()">Take a picture</button>
						</div>
					</div>
				</div>
			</div>
		</div>