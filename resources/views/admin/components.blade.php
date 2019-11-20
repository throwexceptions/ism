
<dashboard-component v-if="panel==1"></dashboard-component>
<supplier-component v-if="panel==2"></supplier-component>
<customer-component v-if="panel==3"></customer-component>
<product-component v-if="panel==4"></product-component>
<receive-component v-if="panel==5"></receive-component>
<shipment-component v-if="panel==6"></shipment-component>
<user-component v-if="panel==7"></user-component>
<log-component v-if="panel==8"></log-component>