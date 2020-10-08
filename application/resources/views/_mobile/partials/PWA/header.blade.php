<ion-header>
	<ion-toolbar color="primary">
	{{--
	  <ion-buttons slot="secondary">
	    <ion-button>
	      <ion-icon slot="icon-only" name="contact"></ion-icon>
	    </ion-button>
	    <ion-chip color="secondary">
		  <ion-label>Default</ion-label>
		</ion-chip>
	  </ion-buttons>
	--}}
	  <ion-buttons slot="start" >
	    <ion-button color="secondary" onclick="openFirst()">
	      <ion-icon slot="icon-only" name="menu"></ion-icon>
	    </ion-button>
	  </ion-buttons>
	  <ion-title color="secondary">{{$title}}</ion-title>
	</ion-toolbar>
</ion-header>