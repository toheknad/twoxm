<template>
  <v-container fixed>
    <v-row container  justify="center" class='main-block' spacing={3}>
      <v-col item xs={12} md={6} class="main-right" style="margin-top:75px">
        <div class="paper background-sky-light profile-block-user">
          <img class='default-img' src="@/assets/img/Dashboard/049-messenger.png"/>
          <h4 class='paper-title-small'>Даниил Янушковский</h4>
          <button class='default-button btn-half btn-sky'>
            <a class="link-for-white" >Выйти</a>
          </button>
          <div class="flex-center" style="padding-bottom:25px">
            <div class="profile-block-statistic profile-border">
              <p class="profile-value-statistic">53</p>
              <p class="profile-under-value-statistic">Слов</p>
            </div>
            <div class="profile-block-statistic profile-border">
              <p class="profile-value-statistic">#1000</p>
              <p class="profile-under-value-statistic">Рейтинг</p>
            </div>
            <div class="profile-block-statistic">
              <p class="profile-value-statistic">10</p>
              <p class="profile-under-value-statistic">Выученно</p>
            </div>
          </div>
        </div>
      </v-col>


      <v-col item xs={3} md={3} class="main-right" style="margin-top:75px">
        <div class="paper background-pink">
          <img class='default-img' src="@/assets/img/Dashboard/067-mortarboard.png"/>
          <h4 class='paper-title-small'>Тренажер</h4>
          <button class='default-button btn-half btn-white' style="width:80%">
            <router-link class="link-for-white" to='/language'>Иностранные слова</router-link>
          </button>
          <button class='default-button btn-half btn-white' style="width:80%">
            <router-link class="link-for-white" to='/login'>Другое</router-link>
          </button>
        </div>
      </v-col>


      <v-col item xs={3} md={3} class="main-right" style="margin-top:75px">
        <div class="paper background-sky">
          <img class='default-img' src="@/assets/img/Dashboard/052-snapchat.png"/>
          <h4 class='paper-title-small'>Повторение</h4>
          <button class='default-button btn-half btn-white' style="width:80%">
            <router-link  class="link-for-white" to='/login'>Приступить</router-link>
          </button>
<!--          <button class='default-button btn-half btn-white' style="width:80%">-->
<!--            <router-link class="link-for-white" to='/login'>Комментарии</router-link>-->
<!--          </button>-->
        </div>
      </v-col>
    </v-row>

<!--    <Grid container  justify="center" class='main-block' spacing={3}>-->
<!--      <Grid item xs={12} md={4} class="main-right" style={{marginTop:75}}>-->
<!--        <Paper class="paper background-pink">-->
<!--          <img class='default-img' src={FirstIcon}/>-->
<!--          <h4 class='paper-title'>Необычные</h4>-->
<!--          <p class='subtitle paper-subtitle'>1424 вопросов</p>-->
<!--          <button class='default-button btn-half btn-white'>-->
<!--            <Link class="link-for-white" to='/login'>Посмотреть все</Link>-->
<!--          </button>-->
<!--        </Paper>-->
<!--      </Grid>-->
<!--      <Grid item xs={12} md={4} class="main-right" style={{marginTop:75}}>-->
<!--        <Paper class='paper background-sky'>-->
<!--          <img class='default-img' src={SecondIcon}/>-->
<!--          <h4 class='paper-title'>От людей</h4>-->
<!--          <p class='subtitle paper-subtitle'>5150 вопросов</p>-->
<!--          <button class='default-button btn-half btn-white'>-->
<!--            <Link class="link-for-white" to='/login'>Посмотреть все</Link>-->
<!--          </button>-->
<!--        </Paper>-->
<!--      </Grid>-->
<!--      <Grid item xs={12} md={4} class="main-right" style={{marginTop:75}}>-->
<!--        <Paper class="paper background-sky-light">-->
<!--          <img class='default-img' src={ThirdIcon}/>-->
<!--          <h4 class='paper-title'>Безумие</h4>-->
<!--          <p class='subtitle paper-subtitle'>1424 вопросов</p>-->
<!--          <button class='default-button btn-half btn-white'>-->
<!--            <Link class="link-for-white" to='/login'>Посмотреть все</Link>-->
<!--          </button>-->
<!--        </Paper>-->
<!--      </Grid>-->
<!--    </Grid>-->
  </v-container>

</template>

<script>
export default {
name: "Dashboard"
}
</script>

<style scoped>

</style>