<template>
        <div id="map" class="map">
        </div>

</template>
<style>
    #map{
        height: 600px;
    }
</style>
<script>
export default {
    mountd(){
        this.map = new google.maps.Map(document.getElementById('map'));
        this.geocoder = new google.maps.Geocoder();
    },
    data(){
        return{
            map:{},
            marker: null,
            geocoder:{},
            address: ''
        }
    },
}
</script>

