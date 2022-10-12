import 'package:flutter/material.dart';
import 'package:gamedev/Screens/Login/login.dart';
import 'package:gamedev/Screens/Signup/signup.dart';
import 'package:gamedev/Screens/Welcome/welcome_screen.dart';
import 'package:gamedev/pdw.dart';
import './pages/home_page.dart';
import './pages/detail_page.dart';
import './pages/explore_page.dart';
import './components/CommentBox.dart';
import 'package:gamedev/pages/edit_profil.dart';
import 'package:flutter/services.dart';

void main() {
  WidgetsFlutterBinding.ensureInitialized();
  SystemChrome.setPreferredOrientations([DeviceOrientation.portraitUp]);
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);

  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
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
            )),
        home: const WelcomeScreen(),
        initialRoute: '/welcome',
        routes: {
          '/loginpage': (context) => const LoginScreen(),
          '/signup': (context) => const SignUpScreen(),
          '/welcome': (context) => const WelcomeScreen(),
          '/homepage': (context) => const HomePage(),
          '/detail-page': (context) => const DetailPage(),
          '/comment': (context) => TestMe(),
          '/explorepage': (context) => const ExplorePage(),
          '/editprofil':(context) => const EditProfil(),
        });
  }
}
