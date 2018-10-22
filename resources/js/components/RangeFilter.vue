<template>
    <!-- <div
    class="w-full form-control form-input"
    id = "slider"
    ref="rangeSlider"></div> -->

    <!-- <input 
    class="w-full form-control form-input ml-2 mr-2"
    id = "slider"
    ref="rangeSlider"
    :min="minimum"
    :max="maximum"
    type="range"> -->

    <div class="w-full form-control form-input pt-2 pl-2 pr-2">
        <vue-slider ref="slider" v-bind="value" v-model="value"></vue-slider>
    </div>
</template>

<script>
// import noUiSlider from 'noUiSlider';
import vueSlider from 'vue-slider-component';
import _ from 'lodash';

export default {
    components: {
        vueSlider
    },
    props: {
        value: {
            type: Array,
            default: []
        },
        options: {
            type: Object,
            default: () => ({})
        }
    },

    data() { 
        return {
            sliderVal: [],
            value: [0, 100],
            width: this.width,
            height: this.height,
            dotSize: 16,
            min: 0,
            max: 100,
            disabled: false,
            show: true,
            useKeyboard: this.useKeyboard,
            tooltip: this.tooltip,
            formatter: "${value}",
            enableCross: false,
            mergeFormatter: "${value1} ~ ${value2}",
            bgStyle: {
                "backgroundColor": "#fff",
                "boxShadow": "inset 0.5px 0.5px 3px 1px rgba(0,0,0,.36)"
            },
            tooltipStyle: {
                "backgroundColor": "#666",
                "borderColor": "#666"
            },
            processStyle: {
                "backgroundColor": "#999"
            }
        }
    },

    computed: {
        width() {
            return this.getOption('width') || "100%";
        },
        height() {
            return this.getOption('height') || "8";
        },
        minimum(){
            return this.getOption('minimum') || 0;
        },
        maximum(){
            return this.getOption('maximum') || 100;
        },
        useKeyboard(){
            return this.getOption('useKeyboard') || true;
        },
        tooltip(){
            return this.getOption('tooltip') || "always";
        }
    },
    mounted() {
        this.$nextTick( () => {
            this.value = [this.minimum, this.maximum];
        });
        const wrapper = document.querySelector('.dropdown-menu div');
        wrapper.classList.remove('overflow-hidden');
    },
    watch: {
        value: _.debounce(function(newValue){
            this.getValue();
        })
    },
    methods: {
        getOption(name) {
            const option = this.options.find(o => o.name === name);
            if (!option) return false;
            return option.value;
        },
        getValue() {
            console.log(this.$refs['slider'].getValue());
            this.$emit('input', this.$refs['slider'].getValue());
        }
    }
}
</script>

<style>
/* Scoped Styles */
.noUi-tooltip {
  display: none;
}
.noUi-active .noUi-tooltip {
  display: block;
}
</style>
