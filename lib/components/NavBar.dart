import 'package:flutter/material.dart';

class NavBar extends StatelessWidget {
  const NavBar({Key? key}) : super(key: key);
  
  @override
  Widget build(BuildContext context) {
    return Drawer(
      backgroundColor: Colors.amber,
      child: ListView(
        padding: EdgeInsets.zero,
        children: [
          UserAccountsDrawerHeader(
            accountName: const Text('Zulfikar Ahmad Komari'),
            accountEmail: const Text('zulwasright@gmail.com'),
            currentAccountPicture: CircleAvatar(
              child: ClipOval(
                child: Image.network(
                    'https://oflutter.com/wp-content/uploads/2021/02/girl-profile.png',
                    width: 90.0,
                    height: 90.0,
                    fit: BoxFit.cover),
              ),
            ),
            decoration: const BoxDecoration(
              color: Color.fromARGB(255, 63, 53, 53),
            ),
          ),
          ListTile(
            leading: const Icon(Icons.account_circle),
            title: const Text('Edit Profil'),
            onTap: () {
              Navigator.pushNamed(context, '/profil');
            },
          ),
          ListTile(
            leading: const Icon(Icons.exit_to_app_sharp),
            title: const Text('Logout'),
            onTap: () {
              Navigator.pushNamed(context, '/loginpage');
            },
          )
        ],
      ),
    );
  }
  


}
