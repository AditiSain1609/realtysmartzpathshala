<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Our Team</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body{
      background: url('assets/img/gallery/section_bg02.png') no-repeat center center fixed; 
        background-size: cover
    }
    .fade-in { opacity:0; transform:translateY(20px); transition:opacity 0.6s ease, transform 0.6s ease; }
    .fade-in.visible { opacity:1; transform:translateY(0); }
    option { background-color: #007bff; color: white; }
  </style>
</head>
<body class="bg-gray-950 text-white min-h-screen flex flex-col">

  <!-- Header -->
  <header class="p-6 bg-gray-900 shadow-md">
    <h1 class="text-3xl font-bold text-center">Meet Our Team</h1>
    <p class="text-center text-gray-400 mt-2">Select a department to explore team members</p>
  </header>

  <!-- Filters -->
  <div class="flex justify-center mt-6 gap-4 flex-wrap">
    <select id="departmentSelect" class="p-3 rounded-xl bg-gray-800 text-white shadow-md border border-gray-700 min-w-[260px]">
      <option value="">-- Select Department --</option>
    </select>
    <input id="searchInput" type="text" placeholder="Search by name or role..." 
           class="p-3 rounded-xl bg-gray-800 text-white shadow-md border border-gray-700 min-w-[260px]">
  </div>

  <!-- Team Section -->
  <main class="flex-1 p-6 flex flex-col items-center">
    <div id="teamContainer" class="w-full max-w-6xl mt-8"></div>
  </main>

  

  <script>
    let allTeam = [];
    let currentDept = "";

    
    const deptIcons = {
      "IT": "💻",
      "HR": "👥",
      "Design": "🎨",
      "Marketing": "📊",
      "Finance": "💰",
      "Sales": "🤝",
      "General": "🏢"
    };

    async function loadTeam() {
      const res = await fetch("team_api.php");
      allTeam = await res.json();
      populateDepartments();
    }

    function populateDepartments() {
      const deptSelect = document.getElementById("departmentSelect");
      const depts = [...new Set(allTeam.map(m => m.department || "General"))];
      depts.forEach(dept => {
        const opt = document.createElement("option");
        opt.value = dept;
        let icon = deptIcons[dept] || "⭐";
        opt.textContent = `${icon} ${dept} Department`;
        deptSelect.appendChild(opt);
      });
    }

    function renderTeam(team) {
      const container = document.getElementById("teamContainer");
      container.innerHTML = "";

      if (!team.length) {
        container.innerHTML = `<p class="text-gray-500 text-center text-lg">No members found.</p>`;
        return;
      }

      // Split Manager vs Members
      const managers = team.filter(m => m.role.toLowerCase().includes("manager"));
      const members = team.filter(m => !m.role.toLowerCase().includes("manager"));

      const wrapper = document.createElement("div");
      wrapper.className = "space-y-10";

      // Manager Section
      if (managers.length) {
        const mgrSection = document.createElement("div");
        mgrSection.innerHTML = `<h2 class="text-xl font-bold mb-4 text-center text-yellow-400">👑 Manager</h2>`;
        const grid = document.createElement("div");
        grid.className = "flex flex-wrap justify-center gap-6";

        managers.forEach((m, i) => {
          const card = document.createElement("div");
          card.className = "p-5 bg-gray-900 rounded-2xl shadow-lg hover:shadow-2xl hover:bg-gray-800 transition transform hover:-translate-y-1 fade-in";
          card.style.transitionDelay = `${i * 100}ms`;
          card.innerHTML = `
            <div class="flex flex-col items-center text-center">
              <img src="${m.photo_url}" class="w-24 h-24 rounded-full object-cover border-2 border-yellow-500 mb-3">
              <h3 class="text-white font-semibold text-lg">${m.name}</h3>
              <p class="text-yellow-400 text-sm">${m.role}</p>
            </div>
          `;
          grid.appendChild(card);
        });

        mgrSection.appendChild(grid);
        wrapper.appendChild(mgrSection);
      }

      // Team Members Section
      if (members.length) {
        const memSection = document.createElement("div");
        memSection.innerHTML = `<h2 class="text-xl font-bold mb-4 text-center text-blue-400">👥 Team Members</h2>`;
        const grid = document.createElement("div");
        grid.className = "grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 justify-center";

        members.forEach((m, i) => {
          const card = document.createElement("div");
          card.className = "p-5 bg-gray-900 rounded-2xl shadow-lg hover:shadow-2xl hover:bg-gray-800 transition transform hover:-translate-y-1 fade-in";
          card.style.transitionDelay = `${i * 100}ms`;
          card.innerHTML = `
            <div class="flex flex-col items-center text-center">
              <img src="${m.photo_url}" class="w-20 h-20 rounded-full object-cover border-2 border-gray-700 mb-3">
              <h3 class="text-white font-semibold text-lg">${m.name}</h3>
              <p class="text-gray-400 text-sm">${m.role}</p>
            </div>
          `;
          grid.appendChild(card);
        });

        memSection.appendChild(grid);
        wrapper.appendChild(memSection);
      }

      container.appendChild(wrapper);
      revealOnScroll();
    }

    // Animation
    function revealOnScroll() {
      const elements = document.querySelectorAll(".fade-in");
      const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add("visible");
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.2 });
      elements.forEach(el => observer.observe(el));
    }

    // Department Change
    document.getElementById("departmentSelect").addEventListener("change", (e) => {
      currentDept = e.target.value;
      const filtered = allTeam.filter(m => m.department === currentDept);
      renderTeam(filtered);
    });

    // Search Filter
    document.getElementById("searchInput").addEventListener("input", (e) => {
      const q = e.target.value.toLowerCase();
      const filtered = allTeam.filter(m => 
        (m.department === currentDept) && 
        (m.name.toLowerCase().includes(q) || m.role.toLowerCase().includes(q))
      );
      renderTeam(filtered);
    });

    loadTeam();
  </script>
</body>
</html>
