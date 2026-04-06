<template>
  <div class="container mt-5 mb-5">
    <div class="row mb-4">
      <div class="col d-flex justify-content-between align-items-center">
        <h2>Movie Tracker</h2>
        <div>
          <button @click="openAddModal" class="btn btn-primary me-2">+ Add Movie</button>
          <button @click="logout" class="btn btn-outline-danger">Logout</button>
        </div>
      </div>
    </div>

    <!-- Movie List Table -->
    <div class="card shadow-sm">
      <div class="card-header bg-white py-3">
        <h5 class="mb-0">Movie List</h5>
      </div>
      <div class="card-body">
        <div v-if="globalLoading" class="text-center py-4">
          <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>

        <div v-else-if="globalError" class="alert alert-danger">
          {{ globalError }}
        </div>

        <div v-else-if="movies.length === 0" class="text-center py-5 text-muted">
          No movies found. Add your first movie to start tracking!
        </div>

        <div v-else class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th>No</th>
                <th>Title</th>
                <th>Genre</th>
                <th>Mood</th>
                <th>Rating</th>
                <th>Notes</th>
                <th class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(movie, index) in movies" :key="movie.id">
                <td>{{ index + 1 }}</td>
                <td class="fw-bold">{{ movie.title }}</td>
                <td><span class="badge bg-secondary">{{ movie.genre || '-' }}</span></td>
                <td>{{ movie.mood || '-' }}</td>
                <td>
                    <span v-if="movie.rating">⭐ {{ movie.rating }} / 10</span>
                    <span v-else>-</span>
                </td>
                <td>{{ movie.notes || '-' }}</td>
                <td class="text-end">
                  <button @click="openEditModal(movie)" class="btn btn-sm btn-outline-primary me-1">Edit</button>
                  <button @click="deleteMovie(movie.id)" class="btn btn-sm btn-outline-danger">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Add / Edit Modal -->
    <div v-if="showModal" class="modal custom-modal d-block" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ isEditing ? 'Edit Movie' : 'Add New Movie' }}</h5>
            <button type="button" class="btn-close" @click="closeModal"></button>
          </div>
          <div class="modal-body">
            <div v-if="formError" class="alert alert-danger">{{ formError }}</div>
            
            <div class="mb-3">
              <label class="form-label">Title</label>
              <input type="text" class="form-control" v-model="form.title" placeholder="Movie title">
            </div>
            
            <div class="mb-3">
              <label class="form-label">Genre</label>
              <input type="text" class="form-control" v-model="form.genre" placeholder="Action, Comedy, etc.">
            </div>
            
            <div class="mb-3">
              <label class="form-label">Mood</label>
              <select class="form-select" v-model="form.mood">
                <option value="" disabled>Select mood</option>
                <option value="happy">Happy</option>
                <option value="sad">Sad</option>
                <option value="excited">Excited</option>
                <option value="bored">Bored</option>
              </select>
            </div>
            
            <div class="mb-3">
              <label class="form-label">Rating (1 - 10)</label>
              <input type="number" class="form-control" v-model="form.rating" min="1" max="10">
            </div>
            
            <div class="mb-3">
              <label class="form-label">Notes</label>
              <textarea class="form-control" v-model="form.notes" rows="3" placeholder="What do you think about this movie?"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="closeModal" :disabled="formLoading">Cancel</button>
            <button type="button" class="btn btn-primary" @click="submitForm" :disabled="formLoading">
              {{ formLoading ? 'Saving...' : 'Save Movie' }}
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Backdrop -->
    <div v-if="showModal" class="modal-backdrop fade show"></div>

  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'MoviesIndex',
  data() {
    return {
      movies: [],
      globalLoading: true,
      globalError: null,
      
      // Modal state
      showModal: false,
      isEditing: false,
      formLoading: false,
      formError: null,
      
      // Form data
      form: {
        id: null,
        title: '',
        genre: '',
        mood: '',
        rating: null,
        notes: ''
      }
    }
  },
  mounted() {
    this.fetchMovies();
  },
  methods: {
    // --- READ ---
    async fetchMovies() {
      this.globalLoading = true;
      this.globalError = null;
      try {
        const response = await axios.get('/movies');
        this.movies = response.data;
      } catch (error) {
        this.globalError = 'Failed to load movies. Please try again.';
        console.error("Error fetching movies:", error);
      } finally {
        this.globalLoading = false;
      }
    },
    
    // --- MODAL CONTROLS ---
    openAddModal() {
      this.isEditing = false;
      this.resetForm();
      this.showModal = true;
    },
    openEditModal(movie) {
      this.isEditing = true;
      this.formError = null;
      // Copy data to form
      this.form = {
        id: movie.id,
        title: movie.title,
        genre: movie.genre,
        mood: movie.mood,
        rating: movie.rating,
        notes: movie.notes
      };
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
      this.resetForm();
    },
    resetForm() {
      this.form = {
        id: null,
        title: '',
        genre: '',
        mood: '',
        rating: null,
        notes: ''
      };
      this.formError = null;
    },
    
    // --- CREATE & UPDATE ---
    async submitForm() {
      if (!this.form.title || !this.form.genre || !this.form.mood) {
        this.formError = "Title, Genre, and Mood fields are required.";
        return;
      }

      this.formLoading = true;
      this.formError = null;
      
      try {
        if (this.isEditing) {
          // UPDATE
          const response = await axios.put(`/movies/${this.form.id}`, this.form);
          // Update the movie in our local array without refetching
          const index = this.movies.findIndex(m => m.id === this.form.id);
          if (index !== -1) {
            this.movies[index] = response.data;
          }
        } else {
          // CREATE
          const response = await axios.post('/movies', this.form);
          // Add newly created movie to array
          this.movies.push(response.data);
        }
        this.closeModal();
      } catch (error) {
        if (error.response && error.response.data && error.response.data.message) {
          this.formError = error.response.data.message;
        } else {
          this.formError = 'An error occurred while saving the movie.';
        }
        console.error("Error saving movie:", error);
      } finally {
        this.formLoading = false;
      }
    },
    
    // --- DELETE ---
    async deleteMovie(id) {
      if (!confirm('Are you sure you want to delete this movie?')) {
        return;
      }
      
      try {
        await axios.delete(`/movies/${id}`);
        // Remove from local array
        this.movies = this.movies.filter(movie => movie.id !== id);
      } catch (error) {
        alert('Failed to delete movie. It might have been already removed.');
        console.error("Error deleting movie:", error);
        this.fetchMovies(); // Refresh list on error
      }
    },

    // --- LOGOUT ---
    async logout() {
      try {
        await axios.post('/logout');
      } catch (error) {
        console.error("Error logging out from server:", error);
      } finally {
        localStorage.removeItem('access_token');
        this.$router.push('/auth/login');
      }
    }
  }
}
</script>

<style scoped>
.custom-modal {
  background-color: rgba(0, 0, 0, 0.5);
  display: block; 
}
</style>
