@extends('layouts.app')

@section('order-create')
<link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
{{-- @include('order.customer-modal') --}}
<div class="container w-full mx-auto">
@if ($errors->any())
    <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
        <p class="font-bold">Error</p>
        @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
        @endforeach     
    </div>
@endif
<br>

<!--  -->


<!-- <input type='text' id='selectuser_id' /> -->



<!--  -->


<form class="w-full max-w-lg" action="/order" method="post">
{{ csrf_field() }}
<div class="w-full md:w-3/3 px-3 mb-6 md:mb-0">
      


  <div class="flex flex-wrap -mx-3 mb-6">
  <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="autocomplete" type="text" placeholder="Busca cliente">
    </div>
    <select name="customer_id" id="customerSel" size="5" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></select>
    <br><br>
    <label for="customer" class="font-bold mb-1 text-gray-700 block" id="customerLabel"></label>
    <div class="w-full md:w-2/2 px-3 mb-6 md:mb-0">
    <div class="antialiased sans-serif">
      <div x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak>
          <div class="container mx-auto px-4 py-2 md:py-10">
              <div class="mb-5 w-64">

                  <label for="datepicker" class="font-bold mb-1 text-gray-700 block">Fecha de entrega</label>
                  <div class="relative">
                      <input type="hidden" name="deadline" x-ref="date">
                      <input 
                          type="text"
                          readonly
                          x-model="datepickerValue"
                          @click="showDatepicker = !showDatepicker"
                          @keydown.escape="showDatepicker = false"
                          class="w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                          placeholder="Select date">

                          <div class="absolute top-0 right-0 px-3 py-2">
                              <svg class="h-6 w-6 text-gray-400"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                              </svg>
                          </div>


                          <!-- <div x-text="no_of_days.length"></div>
                          <div x-text="32 - new Date(year, month, 32).getDate()"></div>
                          <div x-text="new Date(year, month).getDay()"></div> -->

                          <div 
                              class="bg-white mt-12 rounded-lg shadow p-4 absolute top-0 left-0" 
                              style="width: 17rem" 
                              x-show.transition="showDatepicker"
                              @click.away="showDatepicker = false">

                              <div class="flex justify-between items-center mb-2">
                                  <div>
                                      <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
                                      <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                                  </div>
                                  <div>
                                      <button 
                                          type="button"
                                          class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full" 
                                          :class="{'cursor-not-allowed opacity-25': month == 0 }"
                                          :disabled="month == 0 ? true : false"
                                          @click="month--; getNoOfDays()">
                                          <svg class="h-6 w-6 text-gray-500 inline-flex"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                          </svg>  
                                      </button>
                                      <button 
                                          type="button"
                                          class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full" 
                                          :class="{'cursor-not-allowed opacity-25': month == 11 }"
                                          :disabled="month == 11 ? true : false"
                                          @click="month++; getNoOfDays()">
                                          <svg class="h-6 w-6 text-gray-500 inline-flex"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                          </svg>									  
                                      </button>
                                  </div>
                              </div>

                              <div class="flex flex-wrap mb-3 -mx-1">
                                  <template x-for="(day, index) in DAYS" :key="index">	
                                      <div style="width: 14.26%" class="px-1">
                                          <div
                                              x-text="day" 
                                              class="text-gray-800 font-medium text-center text-xs"></div>
                                      </div>
                                  </template>
                              </div>

                              <div class="flex flex-wrap -mx-1">
                                  <template x-for="blankday in blankdays">
                                      <div 
                                          style="width: 14.28%"
                                          class="text-center border p-1 border-transparent text-sm"	
                                      ></div>
                                  </template>	
                                  <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">	
                                      <div style="width: 14.28%" class="px-1 mb-1">
                                          <div
                                              @click="getDateValue(date)"
                                              x-text="date"
                                              class="cursor-pointer text-center text-sm leading-none rounded-full leading-loose transition ease-in-out duration-100"
                                              :class="{'bg-blue-500 text-white': isToday(date) == true, 'text-gray-700 hover:bg-blue-200': isToday(date) == false }"	
                                          ></div>
                                      </div>
                                  </template>
                              </div>
                          </div>

                  </div>	 
              </div>

          </div>
      </div>      
</div>

<div class="md:flex md:items-center mb-6">
    <div class="md:w-3/3"></div>
    <label class="md:w-3/3 block text-gray-500 font-bold">
      <input class="mr-2 leading-tight" name="installation" type="checkbox">
      <span class="text-sm">
        Incluye instalación
      </span>
    </label>
  </div>

  <div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-3/3 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
        Notas/Observaciones
      </label>
      <input name="notes" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-city" type="text" placeholder="Ingrese observaciones">
    </div>

    <div class="w-full px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
        Detalles
      </label>
      <span id="detailField">

 
      <div class="relative">
        <select name="details[products][]" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
          <option value="">producto:</option>
	  @foreach ($products as $product)
	  <option value={{ $product->id }}>{{ $product->name }}</option>
	@endforeach 
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </div>
      </div>

        <input name="details[widths][]" class="appearance-none md:w-1/3 block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Ancho">
        <input name="details[heights][]" class="appearance-none md:w-1/3 block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Alto">
    <label class="md:w-3/3 block text-gray-500 font-bold">
      <input class="mr-2 leading-tight" name="details[frame][]" type="checkbox">
      <span class="text-sm">
        Incluye marco
      </span>
    </label>
      </span>
      
    <div class="md:w-3/3"></div>
      <span id="aditionalFields"></span>
      <button class="shadow bg-green-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-1 px-2 rounded" type="button" onclick="addDetail()">
        Agregar producto
      </button>
    </div>


  </div>
  <br>

  </div><br> 
  <div class="md:flex md:items-center">
    <div class="md:w-3/3"></div>
    <div class="md:w-3/3">
      <button class="shadow bg-gray-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
        Guardar
      </button>
    </div>
  </div>
</form>
</div>





<!-- <div class="h-screen w-screen flex items-center justify-center bg-gray-200 "> -->
  

  <style>
    [x-cloak] {
      display: none;
    }
  </style>

  

      <script>

            $(function () {
                    $( "#autocomplete" ).autocomplete({
                        source: function( request, response ) {
                        // Fetch data
                        $.ajax({
                            url: "/api/customer/search",
                            type: 'post',
                            dataType: "json",
                            data: {
                                searchText: request.term
                            },
                            success: function( data ) {
                                var options = '';

                                for (let i = 0; i < data.length; i++) {
                                    let id = data[i].id;
                                    let fullName = `${data[i]['name']} ${data[i]['lastName']}`;
                                    options += `<option value=${id}>${fullName}</option>`;
                                }
                                $('#customerSel')
                                    .empty()
                                    .append(options);
                            }
                        });
                        }
                    });
		    
                });
            
            $('#customerSel').on('change', ()=> {
                $('#customerLabel').html($('#customerSel option:selected').text());
                $('#autocomplete').val($('#customerSel option:selected').text());
            });

          function addDetail () {
              const input  = document.getElementById('detailField').innerHTML;
              document.getElementById('aditionalFields').insertAdjacentHTML('afterend', input);
          }

          const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
          const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

          function app() {
              return {
                  showDatepicker: false,
                  datepickerValue: '',

                  month: '',
                  year: '',
                  no_of_days: [],
                  blankdays: [],
                  days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

                  initDate() {
                      let today = new Date();
                      this.month = today.getMonth();
                      this.year = today.getFullYear();
                      this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
                  },

                  isToday(date) {
                      const today = new Date();
                      const d = new Date(this.year, this.month, date);

                      return today.toDateString() === d.toDateString() ? true : false;
                  },

                  getDateValue(date) {
                      let selectedDate = new Date(this.year, this.month, date);
                      console.log('selectedDate', selectedDate);
                      this.datepickerValue = selectedDate.toDateString();
                      console.log('Month', selectedDate.getMonth());

                      this.$refs.date.value = selectedDate.getFullYear() +"-"+ ('0'+ (selectedDate.getMonth() + 1) ).slice(-2) +"-"+ ('0' + selectedDate.getDate()).slice(-2);

                      console.log('completeDate', this.$refs.date.value);

                      console.log('checkDay', this.checkDay(this.$refs.date.value));
                      
                      this.showDatepicker = false;
                  },

                  getNoOfDays() {
                      let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

                      // find where to start calendar day of week
                      let dayOfWeek = new Date(this.year, this.month).getDay();
                      let blankdaysArray = [];
                      for ( var i=1; i <= dayOfWeek; i++) {
                          blankdaysArray.push(i);
                      }

                      let daysArray = [];
                      for ( var i=1; i <= daysInMonth; i++) {
                          daysArray.push(i);
                      }

                      this.blankdays = blankdaysArray;
                      this.no_of_days = daysArray;
                  },
                  checkDay (dateToCheck) {
                    // console.log(window.location.origin + '/api/order/check_day');
                    if (dateToCheck) {
                      // console.log('dateTOCheckl', dateToCheck);
                      var request = new XMLHttpRequest();
                      request.open('POST', window.location.origin + '/api/order/check_day', true);
                      request.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');

                      request.onreadystatechange = function() {
                        // console.log('DONE? ', XMLHttpRequest.DONE);
                        if (this.readyState == XMLHttpRequest.DONE && this.status == 200) {
                          console.log('succeed');
                          console.log(request.responseText);
                          if(JSON.parse(request.responseText)['result']){
                            confirm('Dia seleccionado ya tiene limite de ordenes agendadas. Estas seguro de querer agendar?');
                          }
                          
                          // myresponse.value = request.responseText;
                        } else {
                          const d = {
                            readyState: this.readyState,
                            status: this.status
                          };
                          console.log('server error', d);
                        }
                      };

                      request.onerror = function() {
                        console.log('something went wrong');
                      };
                      const data = {'date': dateToCheck};
                      console.log('payload', data);

                      request.send(JSON.stringify(data));
                    }
                    
                  }
              }
          }

          
      </script>
    </div>
<!-- </div> -->

@endsection
