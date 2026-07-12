// ============================================================
// Firebase Configuration — Desa Munggur
// ============================================================

const firebaseConfig = {
  apiKey: "AIzaSyCYuMB0F4nHGb1AehkxJzMZk07vyEVcBUo",
  authDomain: "desamunggur-a8df0.firebaseapp.com",
  projectId: "desamunggur-a8df0",
  storageBucket: "desamunggur-a8df0.firebasestorage.app",
  messagingSenderId: "102940423145",
  appId: "1:102940423145:web:4aa48482c4d8e9805fd178",
  measurementId: "G-WS59TV0XJT"
};

// Inisialisasi Firebase (compat mode — langsung bisa dipakai di browser tanpa bundler)
if (!firebase.apps.length) {
  firebase.initializeApp(firebaseConfig);
}

// Inisialisasi Firestore
const db = firebase.firestore();

// Inisialisasi Auth
const auth = firebase.auth();
