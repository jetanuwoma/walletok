<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function(){
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


});
const menuCtrl = document.querySelector('ion-menu-controller');


function openEnd() {
  menuCtrl.open('end');
}
</script>