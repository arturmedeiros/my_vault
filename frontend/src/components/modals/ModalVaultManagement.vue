<template>
    <q-dialog
        v-model="configs.modals.vault_modal"
        persistent
        :maximized="($q.screen.xs || $q.screen.sm)"
        transition-show="slide-up"
        transition-hide="slide-down"
    >
        <q-card  :style="($q.screen.xs || $q.screen.sm) ? '' : 'min-width: 600px; border-radius: 15px;'">
            <!-- Navbar -->
            <q-toolbar class="q-px-lg" style="height: 65px;">
                <q-avatar v-if="true" square>
                    <q-icon name="password"></q-icon>
                </q-avatar>
                <q-toolbar-title>
                    <div class="q-pl-xs text-h6"
                         style="font-size: 1.3rem;">
                        {{ password.key ? 'Editar' : 'Nova' }}
                        Senha
                    </div>
                </q-toolbar-title>
                <q-btn dense
                       flat
                       rounded
                       icon="close"
                       @click="setModal({ key: 'vault_modal', state: false })">
                </q-btn>
            </q-toolbar>
            <q-separator></q-separator>

            <!-- Conteúdo -->
            <q-card-section class="q-py-none">
                <!--Corpo do Card-->
                <q-card class="no-shadow" :class="($q.screen.xs || $q.screen.sm) ? 'q-px-md' : 'q-px-xs' ">
                    <!--Header da Seção-->
                    <div v-if="false" class="row items-center no-wrap q-pt-md">
                        <div class="col">
                            <div class="text-h6"
                                 style="font-size: 1.1rem;">
                                Configurações
                            </div>
                        </div>
                    </div>
                    <div class="row q-px-none q-pt-md q-pb-lg">
                        <div :class="($q.screen.xs || $q.screen.sm) ? '' : 'q-px-md'"
                             class="col-md-6 col-sm-12 col-xs-12 q-pb-md cursor-default">
                            <q-select
                                rounded
                                color="primary"
                                v-model="type"
                                :options="getTypesList"
                                :option-label="(item) => item === null ? null : item.name"
                                :option-value="(item) => item === null ? null : item.value"
                                label="Tipo">
                                <template v-slot:option="scope">
                                    <q-item v-bind="scope.itemProps">
                                        <q-item-section avatar>
                                            <q-icon :name="scope.opt.icon"/>
                                        </q-item-section>
                                        <q-item-section>
                                            <q-item-label>{{ scope.opt.name }}</q-item-label>
                                            <q-item-label v-if="false" caption>{{ scope.opt.url }}</q-item-label>
                                        </q-item-section>
                                    </q-item>
                                </template>
                            </q-select>
                        </div>
                        <div :class="($q.screen.xs || $q.screen.sm) ? '' : 'q-px-md'"
                             class="col-md-6 col-sm-12 col-xs-12 q-pb-sm cursor-default">
                            <q-input rounded
                                     color="primary"
                                     class="bg-white q-px-none q-pb-md"
                                     placeholder="Dê um nome para esta senha..."
                                     label="Nome"
                                     v-model="password.name"
                            />
                        </div>
                        <div :class="($q.screen.xs || $q.screen.sm) ? '' : 'q-px-md'"
                             class="col-md-12 col-sm-12 col-xs-12 q-pb-sm cursor-default">
                            <q-input rounded
                                     color="primary"
                                     class="bg-white q-px-none q-pb-md"
                                     placeholder="Digite usuário da tela de login..."
                                     label="Login"
                                     v-model="password.login"
                            />
                        </div>
                        <div :class="($q.screen.xs || $q.screen.sm) ? '' : 'q-px-md'"
                             class="col-md-12 col-sm-12 col-xs-12 q-pb-sm cursor-default">
                          <q-input rounded
                                   color="primary"
                                   class="bg-white q-px-none q-pb-md"
                                   placeholder="Descreva sua finalidade..."
                                   label="Descrição"
                                   v-model="password.description"
                          />
                        </div>
                        <div :class="($q.screen.xs || $q.screen.sm) ? '' : 'q-px-md'"
                             class="col-md-6 col-sm-12 col-xs-12 q-pb-sm cursor-default">
                            <q-input rounded
                                     color="primary"
                                     class="bg-white q-px-none q-pb-md"
                                     placeholder="Informe a URL onde usa essa senha..."
                                     label="Link"
                                     v-model="pass_link"
                            />
                        </div>
                        <div :class="($q.screen.xs || $q.screen.sm) ? '' : 'q-px-md'"
                             class="col-md-6 col-sm-12 col-xs-12 q-pb-sm cursor-default">
                            <q-input rounded
                                     color="primary"
                                     class="bg-white q-px-none q-pb-md"
                                     label="Senha"
                                     v-model="password.pass"
                            >
                                <template v-slot:append>
                                    <span @click="generateSecPass()"
                                          class="cursor-pointer text-grey-7 q-pr-xs" style="font-size: .9rem;">Gerar</span>
                                    <q-icon name="refresh"
                                            size="xs"
                                            class="cursor-pointer q-pr-sm cursor-pointer"
                                            @click="generateSecPass()"
                                    />
                                </template>
                            </q-input>
                        </div>
                    </div>
                </q-card>
            </q-card-section>
            <ModalActionsFooter>
                <template v-slot:ModalCTALeft>
                    <ModalFullCTALeft @click="setModal({ key: 'vault_modal', state: false })"
                                      text="Cancelar"
                                      color="primary"
                    />
                </template>
                <template v-slot:ModalCTARight>
                    <ModalFullCTARight @click="setModal({ key: 'vault_modal', state: false })"
                                       text="Salvar"
                                       color="primary"
                    />
                </template>
            </ModalActionsFooter>
        </q-card>
    </q-dialog>
</template>

<script>
import ModalActionsFooter from "components/modals/ModalActionsFooter.vue";
import ModalFullCTALeft from "components/general/ModalFullCTALeft.vue";
import ModalFullCTARight from "components/general/ModalFullCTARight.vue";

export default {
    name: "ModalVaultManagement",
    components: {
        ModalFullCTARight,
        ModalFullCTALeft,
        ModalActionsFooter
    },
    data() {
        return {
            type: null,
            password: {},
            pass_link: null,
        }
    },
  mounted() {
      if (!this.type && this.getTypesList.length > 0) {
        this.type = this.getTypesList[0]
      }
  },
  watch: {
      'getTypesList': function () {
        if (!this.type && this.getTypesList.length > 0) {
          this.type = this.getTypesList[0]
        }
      },
      // Limpa campos ao fechar modal
      'configs.modals.vault_modal': function () {
          if (!this.configs.modals.vault_modal) {
              this.password = {}
              this.pass_link = null
              if (this.getTypesList.length > 0) {
                  this.type = this.getTypesList[0]
              }
          }
      },
      'passwords.password': function () {
        if (this.passwords.password && this.passwords.password.key) {
          this.password = this.passwords.password
        }
      },
      'type': function () {
          if (this.passwords.password && this.passwords.password.key) {
              this.passwords.password.type = this.type.value
              console.log("Alterou tipo de senha para: " + this.type.name +' - '+ this.type.value)
          }
      },
  },
    methods: {
        generateSecPass(size = 12) {
            const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+";
            let pass = "";

            for (let i = 0; i < size; i++) {
                const indices = Math.floor(Math.random() * characters.length);
                pass += characters.charAt(indices);
            }

            this.password.pass = pass;
        }
    }
}
</script>

<style scoped>

</style>
