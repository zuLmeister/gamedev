import 'package:flutter/material.dart';
import 'package:gamedev/Screens/Login/login.dart';
import 'package:gamedev/Screens/Signup/signup.dart';
import 'package:gamedev/Screens/Welcome/welcome_screen.dart';
import 'package:gamedev/components/Commentbox.dart';
import 'package:gamedev/pdw.dart';
import './pages/home_page.dart';
import './pages/detail_page.dart';
import './pages/explore_page.dart';
import 'package:gamedev/pages/edit_profil.dart';
import 'package:gamedev/Screens/Fgdpswd/forgot_password.dart';
import 'package:gamedev/utils/services/local_storage_service.dart';
import 'package:get/get.dart';

Future<void> main() async {
  WidgetsFlutterBinding.ensureInitialized();
  await LocalStorageService.initializePreference();
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);

  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return GetMaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'GAMEREV LOADING',
      theme: ThemeData(
        primaryColor: kPrimaryColor,
        scaffoldBackgroundColor: Colors.white,
        elevatedButtonTheme: ElevatedButtonThemeData(
          style: ElevatedButton.styleFrom(
            elevation: 0,
            primary: kPrimaryColor,
            shape: const StadiumBorder(),
            maximumSize: const Size(double.infinity, 56),
            minimumSize: const Size(double.infinity, 56),
          ),
        ),
        inputDecorationTheme: const InputDecorationTheme(
          filled: true,
          fillColor: kPrimaryLightColor,
          iconColor: kPrimaryColor,
          prefixIconColor: kPrimaryColor,
          contentPadding: EdgeInsets.symmetric(
              horizontal: defaultPadding, vertical: defaultPadding),
          border: OutlineInputBorder(
            borderRadius: BorderRadius.all(Radius.circular(30)),
            borderSide: BorderSide.none,
          ),
        ),
      ),
      getPages: [
        GetPage(name: '/loginpage', page: () => const LoginScreen()),
        GetPage(name: '/signup', page: () => const SignUpScreen()),
        GetPage(name: '/pswd', page: () => const PassScreen()),
        GetPage(name: '/welcome', page: () => const WelcomeScreen()),
        GetPage(name: '/homepage', page: () => const  HomePage()),
        GetPage(name: '/detail-page', page: () => const DetailPage()),
        GetPage(name: '/comment', page: () => TestMe()),
        GetPage(name: '/explorepage', page: () => const ExplorePage()),
        GetPage(name: '/editprofil', page: () => const EditProfil()),
      ],
      home: const WelcomeScreen(),
      initialRoute: getInitialRoute(),
    );
  }

  String getInitialRoute() {
    if (LocalStorageService.getStateLogin()) {
      return '/homepage';
    } else {
      return '/loginpage';
    }
  }
}
