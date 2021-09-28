<template>
  <v-container fixed>
    <loader v-if="$store.state.isLoading"></loader>
    <v-row>
<!--      <v-col cols="12">-->
<!--        <h1>Главная</h1>-->
<!--      </v-col>-->
<!--      <v-col cols="4" item  class="main-right" style="margin-top:75px">-->
<!--        <div class="paper background-sky-light profile-block-user">-->
<!--          <img class='default-img' src="@/assets/img/Dashboard/049-messenger.png"/>-->
<!--          <h4 class='paper-title-small'>{{email}}</h4>-->
<!--          <button class='default-button btn-half btn-sky'>-->
<!--            <a class="link-for-white" >Настройки</a>-->
<!--          </button>-->
<!--          <div class="flex-center" style="padding-bottom:25px">-->
<!--            <div class="profile-block-statistic profile-border">-->
<!--              <p class="profile-value-statistic">{{userStatistic.all}}</p>-->
<!--              <p class="profile-under-value-statistic">Слов</p>-->
<!--            </div>-->
<!--            <div class="profile-block-statistic">-->
<!--              <p class="profile-value-statistic">{{userStatistic.learned}}</p>-->
<!--              <p class="profile-under-value-statistic">Выученно</p>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </v-col>-->
    </v-row>
    <v-row container  justify="center" class='main-block' spacing={3}>
      <v-col cols="12" md="4" sm="12" xs="12"  item class="main-right" style="margin-top:75px">
        <div class="paper background-sky-light profile-block-user">
          <img class='default-img' src="@/assets/img/Dashboard/049-messenger.png"/>
          <h4 class='paper-title-small'>{{email}}</h4>
            <button class='default-button btn-half btn-sky'>
              <a class="link-for-white" >Настройки</a>
            </button>
          <div class="flex-center" style="padding-bottom:25px">
            <div class="profile-block-statistic profile-border">
              <p class="profile-value-statistic">{{userStatistic.all}}</p>
              <p class="profile-under-value-statistic">Слов</p>
            </div>
            <div class="profile-block-statistic">
              <p class="profile-value-statistic">{{userStatistic.learned}}</p>
              <p class="profile-under-value-statistic">Выученно</p>
            </div>
          </div>
        </div>
      </v-col>


      <v-col cols="12"  md="4" sm="12" xs="12" class="main-right" style="margin-top:75px">
        <div class="paper background-pink">
          <img class='default-img' src="@/assets/img/Dashboard/067-mortarboard.png"/>
          <h4 class='paper-title-small'>Тренировки</h4>
          <button class='default-button btn-half btn-white' style="width:80%">
            <router-link class="link-for-white" to='/language'>Добавить слова</router-link>
          </button>
          <button class='default-button btn-half btn-white' style="width:80%">
            <router-link class="link-for-white" to='/repeat'>Повторение</router-link>
          </button>
<!--          <button class='default-button btn-half btn-white' style="width:80%">-->
<!--            <router-link class="link-for-white" to='/login'>Другое</router-link>-->
<!--          </button>-->
        </div>
      </v-col>

<!--      <v-col cols="4" item class="main-right" style="margin-top:75px">-->
<!--        <div class="paper background-sky-light">-->
<!--          <img class='default-img' src="@/assets/img/Dashboard/052-snapchat.png"/>-->
<!--          <h4 class='paper-title-small'>Повторение</h4>-->
<!--          <p class='paper-title-small repeat-subtitle'>-->
<!--            <span v-if="countRepeatWords === '0'">Пока нет слов для повторения</span>-->
<!--            <span v-else>Вам нужно повторить {{countRepeatWords}}</span>-->
<!--          </p>-->
<!--          <button class='default-button btn-half btn-white' style="width:80%">-->
<!--            <router-link  class="link-for-white" to='/repeat'>Приступить</router-link>-->
<!--          </button>-->
<!--        </div>-->
<!--      </v-col>-->
      <v-col cols="12" md="4" sm="12" xs="12">
        <div class="main-method-block blue-background" style="margin-top: 75px">
          <div>
            <p class="main-method-text" style="color:white">Напишите боту, чтобы получать напоминания, когда приходит время повторять слова</p>
            <button class="btn-main">Перейти к боту</button>
          </div>
        </div>
      </v-col>

    </v-row>


  </v-container>

</template>

<script>
import {mapActions, mapGetters} from "vuex";
import Loader from "@/components/Loader";

export default {
  name: "Dashboard",
  data() {
    return {
      email: JSON.parse(localStorage.getItem('user')).email,
      headers: [
        {
          text: 'Слово',
          align: 'start',
          sortable: false,
          value: 'name',
        },
        { text: 'Перевод', value: 'calories' },
        { text: 'Метод', value: 'protein' },
        { text: 'Осталось повторений', value: 'carbs' },
        { text: 'Время', value: 'fat' },
      ],
      desserts: [
        {
          name: 'Frozen Yogurt',
          calories: 159,
          fat: 6.0,
          carbs: 24,
          protein: 4.0,
          iron: '1%',
        },
        {
          name: 'Ice cream sandwich',
          calories: 237,
          fat: 9.0,
          carbs: 37,
          protein: 4.3,
          iron: '1%',
        },
        {
          name: 'Eclair',
          calories: 262,
          fat: 16.0,
          carbs: 23,
          protein: 6.0,
          iron: '7%',
        },
        {
          name: 'Cupcake',
          calories: 305,
          fat: 3.7,
          carbs: 67,
          protein: 4.3,
          iron: '8%',
        },
        {
          name: 'Gingerbread',
          calories: 356,
          fat: 16.0,
          carbs: 49,
          protein: 3.9,
          iron: '16%',
        },
        {
          name: 'Jelly bean',
          calories: 375,
          fat: 0.0,
          carbs: 94,
          protein: 0.0,
          iron: '0%',
        },
        {
          name: 'Lollipop',
          calories: 392,
          fat: 0.2,
          carbs: 98,
          protein: 0,
          iron: '2%',
        },
        {
          name: 'Honeycomb',
          calories: 408,
          fat: 3.2,
          carbs: 87,
          protein: 6.5,
          iron: '45%',
        },
        {
          name: 'Donut',
          calories: 452,
          fat: 25.0,
          carbs: 51,
          protein: 4.9,
          iron: '22%',
        },
        {
          name: 'KitKat',
          calories: 518,
          fat: 26.0,
          carbs: 65,
          protein: 7,
          iron: '6%',
        },
      ],
    };
  },
  components: {
    loader: Loader
  },
  mounted() {
    this.$store.state.isLoading  = true;
    this.getUserStatistic()
    this.$store.state.isLoading  = false;
    console.log(this.userStatistic)
    console.log(this.words)
  },
  computed: {
    ...mapGetters(['userStatistic']),
    countRepeatWords() {
      return this.$store.state.word.countRepeatWords
    }
  },
  created: function () {
    this.$store.dispatch('getCountWordsToRepeat');
  },
  methods: {
    ...mapActions(['getUserStatistic']),
  }
}
</script>

<style scoped>

</style>