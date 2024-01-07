const routes = [
    {
        path: '/',
        component: () => import('layouts/MainLayout.vue'),
        children: [
            {
                path: '',
                name: 'Home',
                component: () => import('pages/Home.vue'),
                meta: {
                    title: 'Dashboard',
                    subtitle: 'Confira todos os detalhes do seu cofre de senhas.',
                    icon: '',
                },
            },
            {
                path: 'passwords',
                name: 'Passwords',
                component: () => import('pages/Passwords.vue'),
                meta: {
                    title: 'Senhas',
                    subtitle: 'Administre suas senhas aqui.',
                    icon: '',
                },
            },
            {
                path: 'users',
                name: 'Users',
                component: () => import('pages/Users.vue'),
                meta: {
                    title: 'Usuários',
                    subtitle: 'Gerecie os usuários do seu cofre.',
                    icon: '',
                },
            },
            {
                path: 'groups',
                name: 'Groups',
                component: () => import('pages/Home.vue'),
                meta: {
                    title: 'Grupos e Permissões',
                    subtitle: 'Administre os grupos de usuários e suas respectivas senhas.',
                    icon: '',
                },
            },
            {
                path: 'settings',
                name: 'Settings',
                component: () => import('pages/Home.vue'),
                meta: {
                    title: 'Configurações',
                    subtitle: 'Configure as opções do seu cofre de senhas aqui.',
                    icon: '',
                },
            },
            {
                path: 'account',
                name: 'Account',
                component: () => import('pages/Account.vue'),
                meta: {
                    title: 'Minha conta',
                    subtitle: 'Edite as configurações da sua conta.',
                    icon: '',
                },
            },
        ]
    },
    {
        path: '/login',
        name: 'Login',
        component: () => import('pages/Login.vue')
    },
    {
        path: '/:catchAll(.*)*',
        name: '404',
        component: () => import('pages/Error404.vue')
    }
]

export default routes
