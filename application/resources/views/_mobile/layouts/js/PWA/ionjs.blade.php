<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function(){

	@if(!Route::is('home'))
    var customActionSheetSelect = document.getElementById('customActionSheetSelect');
	var customActionSheetOptions = {
	  header: 'Wallets',
	  subHeader: 'Select your wallet by its currency',
	};
	customActionSheetSelect.interfaceOptions = customActionSheetOptions;
	customActionSheetSelect.addEventListener('ionChange', function(evt) {
	  
	  //window.location.href = "{{ url('/') }}/wallet/"+evt.target.value;
	  window.location.replace("{{ url('/') }}/wallet/"+evt.target.value);
	});
	@endif


});

const menuCtrl = document.querySelector('ion-menu-controller');

function openFirst() {
  menuCtrl.enable(true, 'first');
  menuCtrl.open('first');
}


function openEnd() {
  menuCtrl.open('end');
}
</script>
