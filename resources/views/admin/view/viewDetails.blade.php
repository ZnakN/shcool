@extends('layouts.admin')

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
                 
                  
					<div class="panel-body">
                                            <img src="{{ asset($trainings->image) }}" alt="no picture" style=' max-height: 200px;'>
                     <?php //Img::show('image',$trainings->image,'brands','500x200',['main'=>'600x500','tumb'=>'125x100']); ?>
                                            <table class='table table-hover' style=''>
                                                <tr>
                                                    <th>ID</th>
                                                    <td>{{ $trainings->id}}</td>
                                                </tr>                   
                   
                                                 <tr>
                                                    <th>Название тренинга</th>
                                                    <td>{{$trainings->training_name}}</td>
                                                </tr>    
                    
                                                <tr>
                                                    <th>Описание тренинга</th>
                                                    <td>{{strip_tags($trainings->description)}}</td>
                                                </tr> 
                                                
                                                 <tr>
                                                    <th>Дата начала</th>
                                                    <td> {{ date('l j F Y',strtotime($trainings->begin_date))}}  </td>
                                                </tr> 
                                                
                                                <tr>
                                                    <th>Дата окончания</th>
                                                    <td> {{date('l j F Y',strtotime($trainings->end_date))}}</td>
                                                </tr> 
                                                  
                                                  <tr>
                                                    <th>Заголовок тега</th>
                                                    <td>{{$trainings->meta_title}}</td>
                                                </tr> 
                                                
                                                   <tr>
                                                    <th>Описание тега</th>
                                                    <td>{{$trainings->meta_description}}</td>
                                                </tr> 
                                                
                                                   <tr>
                                                    <th>Ключевые слова</th>
                                                    <td>{{$trainings->meta_keywords}}</td>
                                                </tr> 
                                                
                                                <tr>
                                                    <th>Статус</th>
                                                    <td> @if ($trainings->status == 1) {!! 'Активный' !!} @endif 
                     @if ($trainings->status != 1) {!! 'Заблокирован'!!} @endif </td>
                                                </tr> 
                                                
                                                <tr>
                                                  <th>Лектор</th>
                                                  <td>{{$trainings->lektor_id}}</td>
                                                </tr>   
                     
                     </table>

                      
                      
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('ls')
<script>

</script>
@endpush


