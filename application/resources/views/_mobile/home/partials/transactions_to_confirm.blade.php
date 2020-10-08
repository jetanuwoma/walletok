
@if($transactions_to_confirm->currentPage() <= $transactions_to_confirm->lastPage() and $transactions_to_confirm->total() > 0 )
  <ion-item-divider>
    <ion-label>
      {{__('Transactions to confirm')}}
    </ion-label>
  </ion-item-divider>
  @forelse($transactions_to_confirm as $transaction)
  <ion-item style="border-bottom: 0 !important;">
      @if($transaction->money_flow != "-") <ion-icon name="trending-up" color="primary" style="no-margin" slot="start"></ion-icon> @else <ion-icon name="trending-down"  style="no-margin" slot="start"></ion-icon> @endif 
        
        <ion-label>
            <div><h4><strong>@include('home.partials.name')</strong></h4><ion-text float-right @if($transaction->money_flow != "-") color="primary" @endif> {{$transaction->gross()}}</ion-text></div>
            <div></div>
            <div><h6><span>{{$transaction->created_at->format('d M Y')}}</span></h6></div>
       </ion-label>
    </ion-item>
      <ion-grid style="border-bottom: 1px solid #ddd;" >
       <ion-row padding>
         <ion-col>
           @if($transaction->transactionable_type == 'App\Models\Send')
            <form action="{{route('sendMoneyConfirm')}}" method="post">
            @elseif($transaction->transactionable_type == 'App\Models\Purchase')
            <form action="{{route('purchaseConfirm')}}" method="post">
            @endif
            
            {{csrf_field()}}
            <input type="hidden" name="tid" value="{{$transaction->id}}">
            
           <ion-button color="light" expand="full" mode="ios" size="small" type="submit"><ion-icon slot="start" color="success" name="checkmark"></ion-icon>{{ __('confirm') }}</ion-button>
            </form>
         </ion-col>
         <ion-col>
           @if($transaction->transactionable_type == 'App\Models\Send')
          <form action="{{route('sendMoneyDelete')}}" method="post">
          @elseif($transaction->transactionable_type == 'App\Models\Purchase')
          <form action="{{route('purchaseDelete')}}" method="post">

          @endif

          {{csrf_field()}}
          <input type="hidden" name="tid" value="{{$transaction->id}}">
          <ion-button color="light" expand="full" mode="ios" size="small" type="submit"><ion-icon name="close" color="danger" slot="start"></ion-icon>{{__('Undo Transaction')}}</ion-button>
          </form>
         </ion-col>
       </ion-row>
      </ion-grid>
  @empty
  @endforelse
  
@endif