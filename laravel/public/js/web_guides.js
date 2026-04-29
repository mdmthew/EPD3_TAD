// Variables globales
let currentProduct = '';
let currentPaymentMethod = 'card';
const purchaseModal = document.getElementById('purchaseModal');
const modalClose = document.getElementById('modalClose');
const purchaseForm = document.getElementById('purchaseForm');
const modalProductName = document.getElementById('modalProductName');

// Datos de los productos
const products = {
    bali: {
        name: 'Guía Esencial de Bali',
        price: '2€',
        description: 'La isla de los dioses desglosada: desde templos secretos hasta playas que no aparecen en las postales.',
        features: ['15 mapas detallados', '+50 locales auténticos', 'Alojamientos verificados']
    },
    italia: {
        name: 'Guía Completa de Italia',
        price: '2€',
        description: 'Del Coliseo a la Costa Amalfitana, pasando por pueblos toscanos que el turismo masivo aún no ha descubierto.',
        features: ['Rutas en tren optimizadas', 'Enoturismo accesible', 'Museos con descuentos']
    }
};

// Inicialización
document.addEventListener('DOMContentLoaded', function() {
    initNavigation();
    initProductCards();
    initPurchaseModal();
    initPaymentMethods();
    initFormValidation();
    initMobileMenu();
    initSmoothScrolling();
    initComingSoonCard();
});

// Navegación y scroll suave
function initNavigation() {
    const nav = document.querySelector('.main-nav');
    let lastScroll = 0;
    
    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll <= 0) {
            nav.style.transform = 'translateY(0)';
            nav.style.boxShadow = 'none';
        } else if (currentScroll > lastScroll && currentScroll > 200) {
            // Scroll hacia abajo
            nav.style.transform = 'translateY(-100%)';
        } else {
            // Scroll hacia arriba
            nav.style.transform = 'translateY(0)';
            nav.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.3)';
        }
        
        lastScroll = currentScroll;
    });
}

// Tarjetas de producto
function initProductCards() {
    const productCards = document.querySelectorAll('.guide-card:not(.coming-soon)');
    
    productCards.forEach(card => {
        // Efecto hover
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-12px)';
            this.style.boxShadow = '0 20px 40px rgba(255, 215, 0, 0.15)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(-8px)';
            this.style.boxShadow = 'var(--shadow-xl)';
        });
        
        // Botón de compra
        const buyBtn = card.querySelector('.guide-buy-btn');
        if (buyBtn) {
            buyBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                const productId = this.getAttribute('data-product');
                openPurchaseModal(productId);
            });
        }
        
        // Botón de detalles
        const detailsBtn = card.querySelector('.guide-details-btn');
        if (detailsBtn) {
            detailsBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                const productId = this.getAttribute('data-product');
                showProductDetails(productId);
            });
        }
        
        // Vista previa
        const previewBtn = card.querySelector('.preview-btn');
        if (previewBtn) {
            previewBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                const productId = card.getAttribute('data-product');
                showProductPreview(productId);
            });
        }
    });
}

// Modal de compra
function initPurchaseModal() {
    // Cerrar modal
    modalClose.addEventListener('click', closePurchaseModal);
    
    // Cerrar al hacer clic fuera
    purchaseModal.addEventListener('click', function(e) {
        if (e.target === this) {
            closePurchaseModal();
        }
    });
    
    // Cerrar con ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && purchaseModal.classList.contains('active')) {
            closePurchaseModal();
        }
    });
    
    // Prevenir que el clic dentro del modal lo cierre
    document.querySelector('.modal-content').addEventListener('click', function(e) {
        e.stopPropagation();
    });
}

// Métodos de pago
function initPaymentMethods() {
    const paymentMethods = document.querySelectorAll('.payment-method');
    const cardDetails = document.getElementById('cardDetails');
    
    paymentMethods.forEach(method => {
        method.addEventListener('click', function() {
            // Remover clase active de todos
            paymentMethods.forEach(m => m.classList.remove('active'));
            
            // Agregar clase active al seleccionado
            this.classList.add('active');
            
            // Actualizar método actual
            currentPaymentMethod = this.getAttribute('data-method');
            
            // Mostrar/ocultar detalles de tarjeta
            if (currentPaymentMethod === 'card') {
                cardDetails.style.display = 'block';
            } else {
                cardDetails.style.display = 'none';
            }
            
            // Actualizar texto del botón según método
            updatePurchaseButton();
        });
    });
}

function updatePurchaseButton() {
    const submitBtn = document.querySelector('.submit-purchase');
    const methodNames = {
        'card': 'Tarjeta',
        'paypal': 'PayPal',
        'transfer': 'Transferencia'
    };
    
    submitBtn.innerHTML = `
        <i class="fas fa-lock"></i>
        Pagar 2€ con ${methodNames[currentPaymentMethod]}
    `;
}

// Validación de formulario
function initFormValidation() {
    // Formatear número de tarjeta
    const cardNumberInput = document.getElementById('cardNumber');
    if (cardNumberInput) {
        cardNumberInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s/g, '').replace(/\D/g, '');
            let formatted = '';
            
            for (let i = 0; i < value.length; i++) {
                if (i > 0 && i % 4 === 0) {
                    formatted += ' ';
                }
                formatted += value[i];
            }
            
            e.target.value = formatted.substring(0, 19);
        });
    }
    
    // Formatear fecha de expiración
    const expiryInput = document.getElementById('expiryDate');
    if (expiryInput) {
        expiryInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            
            if (value.length >= 2) {
                e.target.value = value.substring(0, 2) + '/' + value.substring(2, 4);
            } else {
                e.target.value = value;
            }
        });
    }
    
    // Solo números para CVC
    const cvcInput = document.getElementById('cvc');
    if (cvcInput) {
        cvcInput.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '').substring(0, 4);
        });
    }
    
    // Envío del formulario
    purchaseForm.addEventListener('submit', processPurchase);
}

// Procesar compra
function processPurchase(e) {
    e.preventDefault();
    
    // Validaciones básicas
    const email = document.getElementById('modalEmail').value;
    
    if (!validateEmail(email)) {
        showNotification('Por favor, introduce un email válido', 'error');
        return;
    }
    
    if (currentPaymentMethod === 'card') {
        const cardNumber = document.getElementById('cardNumber').value;
        const expiryDate = document.getElementById('expiryDate').value;
        const cvc = document.getElementById('cvc').value;
        
        if (!validateCardNumber(cardNumber)) {
            showNotification('Número de tarjeta inválido', 'error');
            return;
        }
        
        if (!validateExpiryDate(expiryDate)) {
            showNotification('Fecha de expiración inválida (MM/AA)', 'error');
            return;
        }
        
        if (!validateCVC(cvc)) {
            showNotification('CVC inválido (3 o 4 dígitos)', 'error');
            return;
        }
    }
    
    // Simular procesamiento
    simulatePayment();
}

// Funciones de validación
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function validateCardNumber(number) {
    const cleaned = number.replace(/\s/g, '');
    return /^\d{16}$/.test(cleaned);
}

function validateExpiryDate(date) {
    if (!/^\d{2}\/\d{2}$/.test(date)) return false;
    
    const [month, year] = date.split('/').map(Number);
    const now = new Date();
    const currentYear = now.getFullYear() % 100;
    const currentMonth = now.getMonth() + 1;
    
    if (month < 1 || month > 12) return false;
    if (year < currentYear || (year === currentYear && month < currentMonth)) return false;
    
    return true;
}

function validateCVC(cvc) {
    return /^\d{3,4}$/.test(cvc);
}

// Simular pago
function simulatePayment() {
    const submitBtn = document.querySelector('.submit-purchase');
    const originalText = submitBtn.innerHTML;
    
    // Deshabilitar botón y mostrar carga
    submitBtn.disabled = true;
    submitBtn.innerHTML = `
        <div class="spinner"></div>
        Procesando pago...
    `;
    
    // Simular delay de procesamiento
    setTimeout(() => {
        // Éxito
        submitBtn.innerHTML = `
            <i class="fas fa-check"></i>
            ¡Compra exitosa!
        `;
        
        setTimeout(() => {
            closePurchaseModal();
            showPurchaseSuccess();
            resetForm();
            
            // Restaurar botón
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }, 1000);
        
    }, 2000);
}

// Mostrar éxito de compra
function showPurchaseSuccess() {
    // Crear notificación
    const notification = document.createElement('div');
    notification.className = 'purchase-success';
    notification.innerHTML = `
        <div class="success-content">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="success-text">
                <h4>¡Guía enviada!</h4>
                <p>Hemos enviado "${products[currentProduct].name}" a tu email.</p>
                <p class="success-note">Revisa tu bandeja de entrada (y spam). ¡Buen viaje!</p>
            </div>
            <button class="success-close">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    // Estilos
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 24px;
        background: var(--gray-900);
        border: 1px solid var(--primary);
        border-radius: var(--radius-lg);
        padding: 20px;
        z-index: 2000;
        box-shadow: var(--shadow-xl);
        animation: slideIn 0.3s ease-out;
        max-width: 400px;
    `;
    
    document.body.appendChild(notification);
    
    // Cerrar notificación
    const closeBtn = notification.querySelector('.success-close');
    closeBtn.addEventListener('click', () => {
        notification.style.animation = 'slideOut 0.3s ease-in';
        setTimeout(() => notification.remove(), 300);
    });
    
    // Auto cerrar después de 8 segundos
    setTimeout(() => {
        if (notification.parentNode) {
            notification.style.animation = 'slideOut 0.3s ease-in';
            setTimeout(() => notification.remove(), 300);
        }
    }, 8000);
}

// Abrir modal de compra
function openPurchaseModal(productId) {
    currentProduct = productId;
    const product = products[productId];
    
    // Actualizar contenido del modal
    modalProductName.textContent = product.name;
    
    // Mostrar modal
    purchaseModal.classList.add('active');
    document.body.style.overflow = 'hidden';
    
    // Restablecer método de pago a tarjeta
    document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('active'));
    document.querySelector('.payment-method[data-method="card"]').classList.add('active');
    currentPaymentMethod = 'card';
    document.getElementById('cardDetails').style.display = 'block';
    updatePurchaseButton();
}

function closePurchaseModal() {
    purchaseModal.classList.remove('active');
    document.body.style.overflow = 'auto';
}

function resetForm() {
    purchaseForm.reset();
}

// Detalles del producto
function showProductDetails(productId) {
    const product = products[productId];
    
    // Crear modal de detalles
    const detailModal = document.createElement('div');
    detailModal.className = 'detail-modal';
    detailModal.innerHTML = `
        <div class="detail-content">
            <button class="detail-close">
                <i class="fas fa-times"></i>
            </button>
            <div class="detail-header">
                <h3>${product.name}</h3>
                <div class="detail-price">${product.price}</div>
            </div>
            <div class="detail-body">
                <p class="detail-description">${product.description}</p>
                <div class="detail-features">
                    <h4>Esta guía incluye:</h4>
                    <ul>
                        ${product.features.map(feature => `<li><i class="fas fa-check"></i> ${feature}</li>`).join('')}
                    </ul>
                </div>
                <div class="detail-actions">
                    <button class="detail-buy" data-product="${productId}">
                        <i class="fas fa-shopping-bag"></i>
                        Comprar ahora
                    </button>
                </div>
            </div>
        </div>
    `;
    
    // Estilos
    detailModal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2000;
        animation: fadeIn 0.3s ease-out;
    `;
    
    document.body.appendChild(detailModal);
    document.body.style.overflow = 'hidden';
    
    // Cerrar modal
    const closeBtn = detailModal.querySelector('.detail-close');
    closeBtn.addEventListener('click', () => {
        detailModal.style.animation = 'fadeOut 0.3s ease-in';
        setTimeout(() => {
            detailModal.remove();
            document.body.style.overflow = 'auto';
        }, 300);
    });
    
    // Cerrar al hacer clic fuera
    detailModal.addEventListener('click', (e) => {
        if (e.target === detailModal) {
            detailModal.style.animation = 'fadeOut 0.3s ease-in';
            setTimeout(() => {
                detailModal.remove();
                document.body.style.overflow = 'auto';
            }, 300);
        }
    });
    
    // Botón de compra
    const buyBtn = detailModal.querySelector('.detail-buy');
    buyBtn.addEventListener('click', () => {
        detailModal.remove();
        openPurchaseModal(productId);
    });
}

// Vista previa del producto
function showProductPreview(productId) {
    const previewImages = {
        bali: 'https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
        italia: 'https://images.unsplash.com/photo-1534447677768-be436bb09401?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'
    };
    
    // Crear visor de imagen
    const previewViewer = document.createElement('div');
    previewViewer.className = 'preview-viewer';
    previewViewer.innerHTML = `
        <div class="preview-container">
            <button class="preview-close">
                <i class="fas fa-times"></i>
            </button>
            <div class="preview-image">
                <img src="${previewImages[productId]}" alt="Vista previa">
            </div>
            <div class="preview-info">
                <p>Vista previa de la guía · ${products[productId].name}</p>
            </div>
        </div>
    `;
    
    // Estilos
    previewViewer.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.95);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2000;
        animation: fadeIn 0.3s ease-out;
    `;
    
    document.body.appendChild(previewViewer);
    document.body.style.overflow = 'hidden';
    
    // Cerrar visor
    const closeBtn = previewViewer.querySelector('.preview-close');
    closeBtn.addEventListener('click', () => {
        previewViewer.remove();
        document.body.style.overflow = 'auto';
    });
    
    // Cerrar con ESC
    document.addEventListener('keydown', function closeOnEsc(e) {
        if (e.key === 'Escape') {
            previewViewer.remove();
            document.body.style.overflow = 'auto';
            document.removeEventListener('keydown', closeOnEsc);
        }
    });
}

// Menú móvil
function initMobileMenu() {
    const menuBtn = document.querySelector('.mobile-menu-btn');
    const navLinks = document.querySelector('.nav-links');
    
    if (menuBtn && navLinks) {
        menuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            // CORREGIDO: Operador ternario con sintaxis correcta
            menuBtn.innerHTML = navLinks.classList.contains('active') ? '<i class="fas fa-times"></i>' 
                : '<i class="fas fa-bars"></i>';
        });
        
        // Cerrar menú al hacer clic en un enlace
        document.querySelectorAll('.nav-link, .nav-cta').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
                menuBtn.innerHTML = '<i class="fas fa-bars"></i>';
            });
        });
    }
}

// Scroll suave
function initSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                const headerHeight = document.querySelector('.main-nav').offsetHeight;
                const targetPosition = targetElement.offsetTop - headerHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}

// Tarjeta "Próximamente"
function initComingSoonCard() {
    const notifyBtn = document.querySelector('.guide-notify-btn');
    if (notifyBtn) {
        notifyBtn.addEventListener('click', showNotifyForm);
    }
}

function showNotifyForm() {
    const notifyForm = document.createElement('div');
    notifyForm.className = 'notify-form-modal';
    notifyForm.innerHTML = `
        <div class="notify-content">
            <button class="notify-close">
                <i class="fas fa-times"></i>
            </button>
            <h3>¡Sé el primero en saberlo!</h3>
            <p>Te notificaremos cuando lancemos nuevas guías. También podrás votar por el próximo destino.</p>
            <form class="notify-form">
                <div class="form-group">
                    <input type="email" placeholder="Tu email" required>
                </div>
                <div class="form-group">
                    <select>
                        <option value="">¿Qué destino te interesa?</option>
                        <option value="japon">Japón</option>
                        <option value="mexico">México</option>
                        <option value="grecia">Grecia</option>
                        <option value="tailandia">Tailandia</option>
                        <option value="otros">Otros</option>
                    </select>
                </div>
                <button type="submit" class="notify-submit">
                    <i class="fas fa-bell"></i>
                    Notificarme
                </button>
            </form>
        </div>
    `;
    
    // Estilos
    notifyForm.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2000;
        animation: fadeIn 0.3s ease-out;
    `;
    
    document.body.appendChild(notifyForm);
    document.body.style.overflow = 'hidden';
    
    // Cerrar
    const closeBtn = notifyForm.querySelector('.notify-close');
    closeBtn.addEventListener('click', () => {
        notifyForm.remove();
        document.body.style.overflow = 'auto';
    });
    
    // Enviar formulario
    const form = notifyForm.querySelector('.notify-form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const email = this.querySelector('input[type="email"]').value;
        
        // Simular envío
        const submitBtn = this.querySelector('.notify-submit');
        const originalText = submitBtn.innerHTML;
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<div class="spinner small"></div>';
        
        setTimeout(() => {
            notifyForm.remove();
            document.body.style.overflow = 'auto';
            showNotification('¡Te has suscrito! Te notificaremos sobre nuevos lanzamientos.', 'success');
        }, 1500);
    });
}

// Notificaciones generales
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.textContent = message;
    
    // Estilos
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 24px;
        background: ${type === 'error' ? '#ff4757' : type === 'success' ? '#2ed573' : '#3742fa'};
        color: white;
        padding: 16px 24px;
        border-radius: var(--radius-md);
        z-index: 2000;
        animation: slideIn 0.3s ease-out;
        box-shadow: var(--shadow-md);
        max-width: 300px;
    `;
    
    document.body.appendChild(notification);
    
    // Auto remover
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease-in';
        setTimeout(() => notification.remove(), 300);
    }, 5000);
}

// Animaciones CSS
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }
    
    @keyframes slideIn {
        from { 
            transform: translateX(100%); 
            opacity: 0; 
        }
        to { 
            transform: translateX(0); 
            opacity: 1; 
        }
    }
    
    @keyframes slideOut {
        from { 
            transform: translateX(0); 
            opacity: 1; 
        }
        to { 
            transform: translateX(100%); 
            opacity: 0; 
        }
    }
    
    .spinner {
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: var(--primary);
        animation: spin 1s ease-in-out infinite;
        display: inline-block;
        vertical-align: middle;
        margin-right: 8px;
    }
    
    .spinner.small {
        width: 16px;
        height: 16px;
        border-width: 2px;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    /* Modal de compra activo */
    .purchase-modal.active {
        display: flex;
        animation: fadeIn 0.3s ease-out;
    }
    
    /* Estilos para móvil */
    @media (max-width: 768px) {
        .nav-links {
            position: fixed;
            top: 80px;
            left: 0;
            right: 0;
            background: var(--gray-900);
            flex-direction: column;
            padding: 24px;
            gap: 20px;
            transform: translateY(-100%);
            opacity: 0;
            transition: var(--transition);
            border-bottom: 1px solid var(--gray-800);
            box-shadow: var(--shadow-lg);
        }
        
        .nav-links.active {
            transform: translateY(0);
            opacity: 1;
        }
        
        .mobile-menu-btn {
            display: block;
        }
        
        .hero-container,
        .creators-grid {
            grid-template-columns: 1fr;
        }
        
        .guides-grid {
            grid-template-columns: 1fr;
        }
        
        .hero-visual {
            display: none;
        }
    }
`;

document.head.appendChild(style);

// Accessibility helpers
window.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('img').forEach(img => {
    if (!img.alt) img.alt = 'Imagen decorativa del proyecto';
  });

  const mainMenu = document.getElementById('mainMenu');
  const toggler = document.querySelector('.navbar-toggler');
  if (mainMenu && toggler) {
    mainMenu.addEventListener('shown.bs.collapse', () => toggler.setAttribute('aria-expanded', 'true'));
    mainMenu.addEventListener('hidden.bs.collapse', () => toggler.setAttribute('aria-expanded', 'false'));
  }
});
