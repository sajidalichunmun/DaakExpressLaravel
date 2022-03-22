
    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        {!! Form::label('name','Name') !!}
       
            {!! Form::text('name',null, ['style' => 'text-transform:uppercase;', 'class' => 'form-control', 'minlength' => '1', 'maxlength' => '191', 'required' => false, 'placeholder' => 'Enter name here...', ]) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
      
    </div>
    
    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        {!! Form::label('email','Email') !!}
       
            {!! Form::text('email',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '191', 'required' => false, 'placeholder' => 'Enter email here...', ]) !!}
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
       
    </div>
   
   <!--div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
        {!! Form::label('password','Password') !!}
       
            {!! Form::password('password', ['id' => 'password', 'class' => 'form-control' ,'minlength' => '1', 'maxlength' => '191', 'required' => false, 'placeholder' => 'Enter Password here...', ]) !!}
            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
       
    </div-->
    <!--h4>Assign Role to User</h4>
    <div class="row">
<div class="panel-body">
    <div class="col-md-12">
             @foreach($roles as $role)
                    <div class="col-md-2">
                            <div class="form-group">
                                    <div class="checkbox">
                                        <label for="">
                                            <input type="checkbox" name="roles[]" value="{{$role->id}}" @if(isset($user)) @foreach($role->users as $user_role) @if($user_role->id == $user->id) checked @endif @endforeach @endif>
                                            {{$role->role_name}}  
                                        </label>
                                    </div> 
                                </div>
                        </div>
                    @endforeach
    </div>
</div-->

           
    </div> 
    <h4>Assign Permissions to User</h4>
   
        @if(isset($user))
        <div class="table-responsive" id="employee_table">
					<table class="table table-striped" id="tbExport">
						<thead class="thead-dark">
            <tr>
                    <td>MENU</td>
                    <td>VIEW MENU</td>
                    <td>CREATE</td>
                    <td>VIEW</td>
                    <td>UPDATE</td>
                    <td>DELETE</td>
                    <td>PRINT</td>
                    <td>EXCEL</td>
            </tr>
			</thead>
                <tbody>  
                   <?php
                   $i=0;
                   $j=0;
                    foreach($user->user_menus as $menu){?>


                    @if( isset($menu->menu->company_id) && $menu->menu->company_id)
                    
                  <tr>
                      <td>{{$menu->menu->name}}
                            {{Form::hidden("permissions[$j][menu_id]",$menu->menu->id)}}  
                    </td>
                    <td>
                  
                            <div class="form-group">
                                    <div class="checkbox">
                                        <label for='view_menu'>
                                            {!! Form::checkbox("permissions[$j][view_menu]", '1' , $menu->view_menu ==1 ? true : false) !!}
                                        </label>
                                    </div>
                            </div>
                    </td>
                    <td>
                            <div class="form-group">
                                    <div class="checkbox">
                                        <label for='create'>
                                            {!! Form::checkbox("permissions[$j][create]", '1' , $menu->create ==1 ? true : false) !!}
                                        </label>
                                    </div>
                            </div>
                    </td>
                    <td>
                            <div class="form-group">
                                    <div class="checkbox">
                                        <label for='view'>
                                            {!! Form::checkbox("permissions[$j][view]", '1' , $menu->view ==1 ? true : false) !!}
                                        </label>
                                    </div>
                            </div>
                    </td>
                    <td>
                            <div class="form-group">
                                    <div class="checkbox">
                                        <label for='update'>
                                            {!! Form::checkbox("permissions[$j][update]", '1' , $menu->update ==1 ? true : false) !!}
                                        </label>
                                    </div>
                            </div>
                    </td>
                    <td>
                            <div class="form-group">
                                    <div class="checkbox">
                                        <label for='delete'>
                                            {!! Form::checkbox("permissions[$j][delete]", '1' , $menu->delete ==1 ? true : false) !!}
                                        </label>
                                    </div>
                            </div>
                    </td>
                    <td>
                            <div class="form-group">
                                    <div class="checkbox">
                                        <label for='print'>
                                            {!! Form::checkbox("permissions[$j][print]", '1' , $menu->print ==1 ? true : false) !!}
                                        </label>
                                    </div>
                            </div>
                    </td>
                    <td>
                            <div class="form-group">
                                    <div class="checkbox">
                                        <label for='excel'>
                                            {!! Form::checkbox("permissions[$j][excel]", '1' , $menu->excel ==1 ? true : false) !!}
                                        </label>
                                    </div>
                            </div>
                    </td>
                  </tr>

@endif

                    <?php 
               $j++;
                }?>



                </tbody>
            </table>
        </div>    
        
        
        
        
        
        
        
        
                
        
        
        @else
        <div class="table-responsive" id="employee_table">
					<table class="table table-striped" id="tbExport">
						<thead class="thead-dark">
    
            <tr>
                    <td>MENU</td>
                    <td>VIEW MENU</td>
                    <td>CREATE</td>
                    <td>VIEW</td>
                    <td>UPDATE</td>
                    <td>DELETE</td>
                    <td>PRINT</td>
                    <td>EXCEL</td>
            </tr>
			</thead>
                <tbody>
                   
                      
                 
                   <?php
            
                   $i=0;
                    foreach($menus as $menu){?>
            
                    <tr>
                    <td>{{$menu->name}}
                    {{Form::hidden("permissions[$i][menu_id]",$menu->id)}}   
                    </td>
                    <td>
                            <div class="form-group">
                                    <div class="checkbox">
                                            {!! Form::checkbox("permissions[$i][view_menu]", '1' ,false) !!}
                                    </div> 
                            </div>
                    </td>
                        <td>
                                <div class="form-group">
                                            <div class="checkbox">
                                                    {!! Form::checkbox("permissions[$i][create]", '1', false) !!}  
                                            </div>
                                    </div>
            
                        </td>
                        <td>
                                <div class="form-group">
                                     <div class="checkbox">
                                                    {!! Form::checkbox("permissions[$i][view]", '1', false) !!}
                                     </div>              
                                </div>
            
            
                        </td>
                        <td>
                                <div class="form-group">
                                            <div class="checkbox">
                                                    {!! Form::checkbox("permissions[$i][update]", '1',false) !!}
                                            </div>
                                    </div>
                        </td>
                        <td>
            
                                <div class="form-group">
                                       
                                        
                                            <div class="checkbox">
                                                <label for='delete_1'>
                                                    {!! Form::checkbox("permissions[$i][delete]", '1',  false) !!}
                                                  
                                                </label>
                                            </div>
                                    
                                         
                                    </div>
            
                        </td>
            
            
                        <td>
            
                                <div class="form-group">
                                            <div class="checkbox">
                                                <label for='print'>
                                                    {!! Form::checkbox("permissions[$i][print]", '1',false) !!}
                                                  
                                                </label>
                                            </div>
                                    
                                         
                                    </div>
            
                        </td>
                        <td>
            
                                <div class="form-group">
                                       
                                        
                                            <div class="checkbox">
                                                <label for='excel'>
                                                    {!! Form::checkbox("permissions[$i][excel]", '1',false) !!}
                                                  
                                                </label>
                                            </div>
                                    
                                         
                                    </div>
            
                        </td>
            
                    </tr>
                   
                    
                            </tr>
                  
                 
                    <?php 
                $i++;
                }?>
                </tbody>
            </table>
		</div>
        @endif
    

    
    