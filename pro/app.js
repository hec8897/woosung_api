// new Vue({
//     template:` <div class='bar'>
//     <div class='side left'></div>
//                 <div class='arrow'>
//                     <img src='skmd_1/arrimg.gif' @click="prev">
//                     <img src='skmd_1/arrimg1.gif' @click="next">
//                 </div>
//                 <div class='side right'></div>
//                 <div class='desc'>
//                     <span 
//                     v-bind:class="{
//                         t_red:notice.cate == 'FAQ',
//                         t_blue:notice.cate == 'QnA',
//                         t_yellow:notice.cate == '공지사항'
//                     }"
//                     >[{{notice.cate}}]</span>
//                     <b>{{notice.tit}}</b>
//                 </div>
//             </div>`,
//               data(){
//                   return{
//                       no:0,
//                       notice:"",
//                       notices:""
//                   }
//                 },
//                 created() {
//                     const BaseData = "../board.data.php"
//                     axios.post(BaseData,{mode:'page'})
//                     .then((result)=>{
//                         this.notices = result.data.result;
//                         this.notice = this.notices[0]
//                         console.log(result);
//                     })
//                 },
//                 mounted() {

//                     setInterval(() => {
//                         if(this.notices.length-1 > this.no){
//                             this.no+=1;
//                             this.notice = this.notices[this.no]
//                         }
//                         else{
//                             this.no = 0
//                             this.notice = this.notices[0]
//                         }

//                     }, 2000);
//                 },
//                 methods: {
//                     next(){
//                         if(this.notices.length-1 > this.no){
//                             this.no+=1;
//                             this.notice = this.notices[this.no]
//                         }
//                         else{
//                             this.no = 0
//                             this.notice = this.notices[0]
//                         }

//                     },
//                     prev(){
//                         if(this.no == 0){
//                             this.no = 0
//                             this.notice = this.notices[0]

//                         }
//                         else{
//                             this.no-=1;
//                             this.notice = this.notices[this.no]
//                         }
//                     }
//                 },

// }).$mount('#app')

"use strict";

new Vue({
  template: " <div class='bar'>\n    <div class='side left'></div>\n                <div class='arrow'>\n                    <img src='skmd_1/arrimg.gif' @click=\"prev\">\n                    <img src='skmd_1/arrimg1.gif' @click=\"next\">\n                </div>\n                <div class='side right'></div>\n                <div class='desc'>\n                    <span \n                    v-bind:class=\"{\n                        t_red:notice.cate == 'FAQ',\n                        t_blue:notice.cate == 'QnA',\n                        t_yellow:notice.cate == '\uACF5\uC9C0\uC0AC\uD56D'\n                    }\"\n                    >[{{notice.cate}}]</span>\n                    <b>{{notice.tit}}</b>\n                </div>\n            </div>",
  data: function data() {
    return {
      no: 0,
      notice: "",
      notices: ""
    };
  },
  created: function created() {
    var _this = this;

    var BaseData = "../board.data.php";
    axios.post(BaseData, {
      mode: 'page'
    }).then(function (result) {
      _this.notices = result.data.result;
      _this.notice = _this.notices[0];
      console.log(result);
    });
  },
  mounted: function mounted() {
    var _this2 = this;

    setInterval(function () {
      if (_this2.notices.length - 1 > _this2.no) {
        _this2.no += 1;
        _this2.notice = _this2.notices[_this2.no];
      } else {
        _this2.no = 0;
        _this2.notice = _this2.notices[0];
      }
    }, 2000);
  },
  methods: {
    next: function next() {
      if (this.notices.length - 1 > this.no) {
        this.no += 1;
        this.notice = this.notices[this.no];
      } else {
        this.no = 0;
        this.notice = this.notices[0];
      }
    },
    prev: function prev() {
      if (this.no == 0) {
        this.no = 0;
        this.notice = this.notices[0];
      } else {
        this.no -= 1;
        this.notice = this.notices[this.no];
      }
    }
  }
}).$mount('#app');