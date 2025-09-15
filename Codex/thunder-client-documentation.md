# Documentazione dei Test API con Thunder Client

## Introduzione
Questa documentazione fornisce indicazioni su come utilizzare Thunder Client per testare le API di autenticazione del progetto Codex. I test verificano che il sistema di autenticazione funzioni correttamente per utenti registrati nella tabella `contatti` con credenziali nella tabella `auth`.

## Prerequisiti
1. Visual Studio Code con l'estensione Thunder Client installata
2. Server web locale (XAMPP) in esecuzione
3. Il database del progetto configurato con dati di test

## Importazione della Collection e dell'Environment
1. Apri VS Code e l'estensione Thunder Client
2. Vai su Collections -> Import -> Scegli il file "thunder-collection_API-Authentication-Tests.json"
3. Vai su Environments -> Import -> Scegli il file "thunder-environment_API-Testing.json"

## Test Disponibili

### 1. Login
Questo test verifica che un utente registrato possa effettuare l'accesso con credenziali valide.

**Endpoint**: `{{baseUrl}}/auth/login`  
**Metodo**: POST  
**Body**:
```json
{
  "email": "utente@example.com",
  "password": "password123"
}
```

**Test Eseguiti**:
- Verifica che il codice di risposta sia 200
- Verifica che il campo "success" sia "true"
- Verifica che il token JWT sia presente nella risposta

### 2. Login - Credenziali non valide
Questo test verifica che il sistema rifiuti le credenziali non valide.

**Endpoint**: `{{baseUrl}}/auth/login`  
**Metodo**: POST  
**Body**:
```json
{
  "email": "utente@example.com",
  "password": "passwordErrata"
}
```

**Test Eseguiti**:
- Verifica che il codice di risposta sia 401
- Verifica che il campo "success" sia "false"
- Verifica che il messaggio di errore contenga "Credenziali non valide"

## Esecuzione dei Test
1. Seleziona l'ambiente "API Testing" dalla lista degli ambienti
2. Vai alla collezione "API Authentication Tests"
3. Puoi eseguire un singolo test cliccando su di esso e poi sul pulsante "Send"
4. Per eseguire tutti i test della collezione, fai clic con il tasto destro sulla collezione e seleziona "Run All"

## Note Importanti
- Assicurati di avere dati di test nel tuo database con username e password validi
- Se desideri testare con credenziali diverse, modifica i dati nel body delle richieste
- La variabile d'ambiente `{{baseUrl}}` è configurata per puntare all'URL base dell'API locale

## Risoluzione dei Problemi
- Se ricevi errori 404, verifica che il server web sia in esecuzione e che l'URL dell'API sia corretto
- Se ricevi errori 500, controlla i log del server per identificare eventuali problemi nel codice
- Se i test falliscono ma l'API sembra funzionare correttamente, verifica che i test di Thunder Client abbiano valori corretti
